//
//  ForgotPasswordViewController.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 04/05/21.
//

import UIKit
import SkyFloatingLabelTextField
class ForgotPasswordViewController: UIViewController {

    @IBOutlet weak var txtEmailAddress: SkyFloatingLabelTextField!
    
    @IBOutlet weak var lblMessage: UILabel!
    @IBOutlet weak var lblResetPassword: UILabel!
    @IBOutlet weak var btnReset: UIButton!
 
    override func viewDidLoad() {
        super.viewDidLoad()
//        showAlertWithActivityIndicator(self: self, show: true, message: "Verification is in progress...")
        txtEmailAddress.keyboardType = .emailAddress
        txtEmailAddress.autocorrectionType = .no
        txtEmailAddress.autocapitalizationType = .none
        [txtEmailAddress].forEach { (skyFloatingTextField) in
            skyFloatingTextField?.lineView.isHidden = true
            skyFloatingTextField?.titleFont = UIFont(name: "Roboto-Medium", size: 15)!
            skyFloatingTextField?.placeholderFont = UIFont(name: "Roboto-Medium", size: 15)!
            skyFloatingTextField?.font = UIFont(name: "Roboto-Medium", size: 15)!
            skyFloatingTextField?.titleFormatter = { (text: String) -> String in
                return text
            }
        }

        txtEmailAddress.placeholder = "Email Address".localized()
        txtEmailAddress.selectedTitle = "Email Address".localized()
        lblResetPassword.text = "Reset your password".localized()
        lblMessage.text = "Enter the email address you used to create your account and we will email you a link to reset your password".localized()
        btnReset.setTitle("Reset".localized(), for: .normal)

    }
    override func viewDidLayoutSubviews() {
        super.viewDidLayoutSubviews()
        btnReset.addCorner()
        btnReset.addBorder()
        self.view.layoutSubviews()
    }
    override func viewWillAppear(_ animated: Bool) {
        super.viewWillAppear(animated)
        self.navigationController?.navigationBar.isHidden = false
        navigationController?.navigationBar.barTintColor = #colorLiteral(red: 0.1176470588, green: 0.262745098, blue: 0.3333333333, alpha: 1)
        navigationItem.title = "Forgot password".localized()
        self.navigationController?.navigationBar.tintColor = #colorLiteral(red: 0.2862745098, green: 1, blue: 0, alpha: 1)
                let attrs = [
            NSAttributedString.Key.foregroundColor: UIColor.white,
            NSAttributedString.Key.font: UIFont(name: "Roboto-Bold", size: 22)!
        ]
        self.navigationController?.navigationBar.titleTextAttributes = attrs
        self.tabBarController?.tabBar.isHidden = true

    }
    override func viewWillDisappear(_ animated: Bool) {
        navigationItem.title = ""
    }
    
    @IBAction func btnResetDidTap(_ sender: Any) {
        if txtEmailAddress.hasText{
            if self.isValidEmail(txtEmailAddress.text!) == true {
               // showActivityIndicator(self: self, show: true, message: "Verification is in progress...")
                self.resendOtp(emailID: txtEmailAddress.text ?? "")
            }else{
                showDefaultAlert(viewController: self, title: "Message".localized(), msg: "Please Enter Valid Email Address".localized())
            }
        }else{
            showDefaultAlert(viewController: self, title: "Message".localized(), msg: "Please Enter Email Address".localized())
        }
    }

}


//MARK:- ResendOTP
extension ForgotPasswordViewController {

    func resendOtp(emailID:String)  {
        openAlertPopup(selfVc: self, alertMessage: "Processing...".localized(), showAlert: true)
//        showActivityIndicator(self: self, show: true, message: "Please check your entered email and follow the steps.")
        ServiceManager.sharedInstance.postMethodAlamofire("api/resendotp", dictionary: ["email":emailID], withHud: false) { [self] (success, response, error) in
//            showActivityIndicator(self: self, show: false, message: "Please check your entered email and follow the steps.")
            if success {
                openAlertPopup(selfVc: self, alertMessage: "", showAlert: false)
                
                if response!["status"] as! Bool == true {
                   // showActivityIndicator(self: self, show: false, message: "")
                    if let otp = response!["otp"] as? Int {
                        let nextVC = UIStoryboard(name: "Profile", bundle: Bundle.main).instantiateViewController(withIdentifier: "ConfirmationCodeViewController") as! ConfirmationCodeViewController
                        nextVC.otpFrom = VerificationCodeFrom.forgotPassword
                        nextVC.otpValue = otp
                        nextVC.userEmailAddress = self.txtEmailAddress.text ?? ""
                        
                        self.navigationController?.pushViewController(nextVC, animated: true)
                    }
                }else{
                    showDefaultAlert(viewController: self, title: "Error", msg: "You are not registered with us".localized())
                }
            }else{//You are not registered with us
                //self.showAlertWithOkButton(message: "Failed")
            }
        }
    }
}


//
//  NewPasswordViewController.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 04/05/21.
//

import UIKit
import SkyFloatingLabelTextField
class NewPasswordViewController: UIViewController {

    @IBOutlet weak var lblResetPassword: UILabel!
    @IBOutlet weak var txtConfirmPasswrd: SkyFloatingLabelTextField!
    @IBOutlet weak var txtNewPasswrd: SkyFloatingLabelTextField!
    @IBOutlet weak var btnReset: UIButton!
    var userEmailAddress:String?
    var newPassword: String = "", reEnteredPassword: String = ""
    override func viewDidLoad() {
        super.viewDidLoad()

        self.navigationController?.navigationBar.isHidden = false
        navigationController?.navigationBar.barTintColor = #colorLiteral(red: 0.1176470588, green: 0.262745098, blue: 0.3333333333, alpha: 1)
        navigationItem.title = "New Password".localized()
        self.navigationController?.navigationBar.tintColor = #colorLiteral(red: 0.2862745098, green: 1, blue: 0, alpha: 1)
                let attrs = [
            NSAttributedString.Key.foregroundColor: UIColor.white,
            NSAttributedString.Key.font: UIFont(name: "Roboto-Bold", size: 22)!
        ]
        self.navigationController?.navigationBar.titleTextAttributes = attrs
        
        txtNewPasswrd.isSecureTextEntry = true
        txtConfirmPasswrd.isSecureTextEntry = true
        [txtNewPasswrd,txtConfirmPasswrd].forEach { (skyFloatingTextField) in
            skyFloatingTextField?.lineView.isHidden = true
            skyFloatingTextField?.titleFont = UIFont(name: "Roboto-Medium", size: 15)!
            skyFloatingTextField?.placeholderFont = UIFont(name: "Roboto-Medium", size: 15)!
            skyFloatingTextField?.font = UIFont(name: "Roboto-Medium", size: 15)!
            skyFloatingTextField?.titleFormatter = { (text: String) -> String in
                return text
            }
        }
        txtNewPasswrd.placeholder = "New Password".localized()
        txtConfirmPasswrd.placeholder = "Re-Enter New Password".localized()
        txtNewPasswrd.selectedTitle = "New Password".localized()
        txtConfirmPasswrd.selectedTitle = "Re-Enter New Password".localized()
        lblResetPassword.text = "Enter a new password below.".localized()
        btnReset.setTitle("SUBMIT".localized(), for: .normal)

    }
    
    override func viewWillAppear(_ animated: Bool) {
        super.viewWillAppear(animated)
        self.tabBarController?.tabBar.isHidden = true

    }
    override func viewDidLayoutSubviews() {
        super.viewDidLayoutSubviews()
        btnReset.addCorner()
        btnReset.addBorder()
    }
    var isValid:(Bool, String?, String?) {
        newPassword = txtNewPasswrd.text ?? ""
        reEnteredPassword = txtConfirmPasswrd.text ?? ""
         if newPassword.isEmpty {
            showDefaultAlert(viewController: self, title: "", msg: "Please Enter Password".localized())
            return (false, nil , nil)
        }
         else if !limitValidation(string: newPassword, minLength: 5, maxLength: 0){
            showDefaultAlert(viewController: self, title: "", msg: "Please Enter Minimum 5 Characters In Password".localized())
             return (false, nil , nil)
         }
         
        else if reEnteredPassword.isEmpty {
            showDefaultAlert(viewController: self, title: "", msg: "Please Enter Confirm Password".localized())
            return (false, nil , nil)
        }
        
        else if !limitValidation(string: reEnteredPassword, minLength: 5, maxLength: 0){
            showDefaultAlert(viewController: self, title: "", msg: "Please Enter Minimum 5 Characters In Re-enter Password".localized())
            return (false, nil , nil)
        }
        else if newPassword != reEnteredPassword {
            showDefaultAlert(viewController: self, title: "", msg: "Passwords do not match")
            return (false, nil , nil)
        }
        return (true, newPassword, reEnteredPassword )
    }
    
    
    @IBAction func btnResetDidTap(_ sender: Any) {
        
        let (isValid, password, _ ) = self.isValid
        guard isValid else {
            return
        }
        if let emailAdd = userEmailAddress {
            if !(emailAdd.isEmpty) {
                self.resetPassword(emailID: emailAdd, password: password ?? "")
            }
        }
      
    }
}

//MARK:- Reset Password
extension NewPasswordViewController {
   
    func resetPassword(emailID:String,password:String)  {
        openAlertPopup(selfVc: self, alertMessage: "Processing...", showAlert: true)
        ServiceManager.sharedInstance.postMethodAlamofire("api/resetpassword", dictionary: ["email":emailID,"new_password":password], withHud: false) { (success, response, error) in
            if success {
                if response!["status"] as! Bool == true {
                    DispatchQueue.main.async {
                        self.moveToSuccess()
                    }
                }else{
                    openAlertPopup(selfVc: self, alertMessage: "Processing...", showAlert: false)
                    let responseMsg = ((response as! NSDictionary)["message"] as! String)
                    showDefaultAlert(viewController: self, title: "Error", msg: responseMsg)
                }
            }else{
                openAlertPopup(selfVc: self, alertMessage: "Processing...", showAlert: false)
                showDefaultAlert(viewController: self, title: "", msg: error!.localizedDescription)
            }
        }
    }
    
    func moveToSuccess(){
        DispatchQueue.main.asyncAfter(deadline: .now() + 0.5) {
            openAlertPopup(selfVc: self, alertMessage: "Processing...", showAlert: false)
            let nextVC = UIStoryboard(name: "Profile", bundle: Bundle.main).instantiateViewController(identifier: "VerifiedResetViewController") as! VerifiedResetViewController
            nextVC.verificationFrom = VerificationSuccessFrom.forgotPassword
            self.navigationController?.pushViewController(nextVC, animated: true)
        }
    }
}

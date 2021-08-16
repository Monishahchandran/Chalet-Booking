//
//  ConfirmationCodeViewController.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 04/05/21.
//

import UIKit
import SVPinView

class ConfirmationCodeViewController: UIViewController {

    @IBOutlet weak var lblEnterConfirmationCode: UILabel!
    @IBOutlet weak var lblInValidCode: UILabel!
    @IBOutlet weak var txtOtpField: SVPinView!
    @IBOutlet weak var lblTimeOut: UILabel!
    @IBOutlet weak var lblEmailAddress: UILabel!
    @IBOutlet weak var lbl4DigitCode: UILabel!
    @IBOutlet weak var imgViewForLock: UIImageView!
    @IBOutlet weak var lblTimerCountdown: UILabel!
    @IBOutlet weak var btnRequestResendOtp: UIButton!
    
    var otpFrom:VerificationCodeFrom?
    var otpValue:Int?
    var userId:Int?
    var userEmailAddress:String?
    var totalTime = 60
    var timer: Timer?

    override func viewDidLoad() {
        super.viewDidLoad()
        txtOtpField.style = .none
        txtOtpField.fieldBackgroundColor = UIColor.white
        txtOtpField.fieldCornerRadius = 5
        navigationBarSetup()
        lblEmailAddress.text = userEmailAddress ?? ""
        setUpForOTPTextField()
        startOtpTimer()
        showCustomAlert(title: "OTP Sent".localized(), message: "", isError: false)
        btnRequestResendOtp.setTitle("Request a new one".localized(), for: .normal)
        lblTimeOut.text = "\("Timeout in".localized()) :"
        lblInValidCode.text = "Invalid code. Please check your code and try again".localized()
        
        let attrsWhatKindOfJob1 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Light", size: 15)!, NSAttributedString.Key.foregroundColor : #colorLiteral(red: 1, green: 1, blue: 1, alpha: 1)] as [NSAttributedString.Key : Any]
        
        let attrsWhatKindOfJob2 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Bold", size: 15)!, NSAttributedString.Key.foregroundColor : #colorLiteral(red: 1, green: 1, blue: 1, alpha: 1)] as [NSAttributedString.Key : Any]
        
        let attributedStringWhatKindOfJob1 = NSMutableAttributedString(string:"Enter the ", attributes:attrsWhatKindOfJob1)
        let attributedStringWhatKindOfJob2 = NSMutableAttributedString(string:"4-digit ", attributes:attrsWhatKindOfJob2)
        let attributedStringWhatKindOfJob3 = NSMutableAttributedString(string:"code we sent to", attributes:attrsWhatKindOfJob1)
        attributedStringWhatKindOfJob1.append(attributedStringWhatKindOfJob2)
        attributedStringWhatKindOfJob1.append(attributedStringWhatKindOfJob3)
        self.lbl4DigitCode.attributedText = attributedStringWhatKindOfJob1

    }
    override func viewWillAppear(_ animated: Bool) {
      
        super.viewWillAppear(animated)
        navigationBarSetup()
        clearOTPTextfield()
        self.tabBarController?.tabBar.isHidden = true

    }

    
    func navigationBarSetup(){
        self.navigationController?.navigationBar.isHidden = false
        navigationController?.navigationBar.barTintColor = #colorLiteral(red: 0.1176470588, green: 0.262745098, blue: 0.3333333333, alpha: 1)
        navigationItem.title = "Confirmation Code".localized()
        self.navigationController?.navigationBar.tintColor = #colorLiteral(red: 0.2862745098, green: 1, blue: 0, alpha: 1)
                let attrs = [
            NSAttributedString.Key.foregroundColor: UIColor.white,
            NSAttributedString.Key.font: UIFont(name: "Roboto-Bold", size: 22)!
        ]
        self.navigationController?.navigationBar.titleTextAttributes = attrs
    }
    
    override func viewWillDisappear(_ animated: Bool) {
        navigationItem.title = ""
    }
    
    //MARK:- @IBAction
    @IBAction func btnRequestNewOTPDidTap(_ sender: Any) {
        if let emailAdd = userEmailAddress {
            if !emailAdd.isEmpty{
                if self.isValidEmail(emailAdd) == true {
                    self.resendOtp(emailID: emailAdd)
                }else{
                    showDefaultAlert(viewController: self, title: "", msg: "Please Enter Valid Email Address".localized())
                }
            }else{
                showDefaultAlert(viewController: self, title: "", msg: "Please Enter Email Address and Password".localized())
            }
        }
    }
    
    func showTimerLabel(hide:Bool){
        lblTimerCountdown.isHidden = hide
        lblTimeOut.isHidden = hide
        
    }
    
    private func startOtpTimer() {
//        self.activityIndicator.stopAnimating()
        lblInValidCode.isHidden = true
        btnRequestResendOtp.isHidden = true
        showTimerLabel(hide: false)
        self.totalTime = 60
        self.timer = Timer.scheduledTimer(timeInterval: 1.0, target: self, selector: #selector(updateTimer), userInfo: nil, repeats: true)
    }
    
    @objc func updateTimer() {
        self.lblTimerCountdown.text = timeFormatted(self.totalTime) // will show timer
        if totalTime != 0 {
            totalTime -= 1  // decrease counter timer
        } else {
            if let timer = self.timer {
                timer.invalidate()
                self.timer = nil
                otpValue = nil
                showTimerLabel(hide: true)
                btnRequestResendOtp.isHidden = false
            }
        }
    }


}
//MARK:- setUpForOTPTextField
extension ConfirmationCodeViewController {
    func clearOTPTextfield(){
        txtOtpField.becomeFirstResponderAtIndex = 0
        txtOtpField.clearPin()
    }
    
    func setUpForOTPTextField(){
        txtOtpField.becomeFirstResponderAtIndex = 0
        txtOtpField.font = UIFont.systemFont(ofSize: 15)
        txtOtpField.keyboardType = .phonePad
        txtOtpField.keyboardAppearance = .default
        txtOtpField.shouldSecureText = false
        txtOtpField.allowsWhitespaces = false
        txtOtpField.tintColor = #colorLiteral(red: 1, green: 0.4117647059, blue: 0.4117647059, alpha: 1)
        txtOtpField.becomeFirstResponderAtIndex = 0
        txtOtpField.shouldDismissKeyboardOnEmptyFirstField = false
        txtOtpField.font = UIFont(name: "Roboto-Bold", size: 20)!
        txtOtpField.keyboardType = .phonePad
        txtOtpField.didFinishCallback = didFinishEnteringPin(pin:)
        txtOtpField.didChangeCallback = { pin in
            print("The entered pin is \(pin)")
        }
    }
    
    func didFinishEnteringPin(pin:String) {
        if otpValue != nil {
            
            if otpFrom == VerificationCodeFrom.signUp {
//                activityIndicator.startAnimating()
                if pin == "\(otpValue ?? 0)" {
                    lblInValidCode.isHidden = true
                    verifyEmail(userid: "\(userId ?? 0)")
                }else {
                    clearOTPTextfield()
//                    self.activityIndicator.stopAnimating()
                    lblInValidCode.isHidden = false
                }
            }else {
//                self.activityIndicator.startAnimating()
                if pin == "\(otpValue ?? 0)" {
//                    self.activityIndicator.stopAnimating()
                    lblInValidCode.isHidden = true
                    let nextVC = UIStoryboard(name: "Profile", bundle: Bundle.main).instantiateViewController(withIdentifier: "NewPasswordViewController") as! NewPasswordViewController
                    nextVC.userEmailAddress = userEmailAddress
                    self.navigationController?.pushViewController(nextVC, animated: true)
                }else {
                    clearOTPTextfield()
//                    self.activityIndicator.stopAnimating()
                    lblInValidCode.isHidden = false
                }
            }
        }else {
            clearOTPTextfield()
            btnRequestResendOtp.isHidden = false
            showDefaultAlert(viewController: self, title: "Invalid OTP".localized(), msg: "Please Request a new OTP".localized())
            
        }
    }

    // MARK: Helper Functions
    func showAlert(title:String, message:String) {
        let alert = UIAlertController(title: title, message: message, preferredStyle: UIAlertController.Style.alert)
        alert.addAction(UIAlertAction(title: "OK".localized(), style: UIAlertAction.Style.default, handler: nil))
        self.present(alert, animated: true, completion: nil)
    }
}


//MARK:- Verify Email
extension ConfirmationCodeViewController {
    
    func verifyEmail(userid:String)  {
        openAlertPopup(selfVc: self, alertMessage: "Processing...".localized(), showAlert: true)
        ServiceManager.sharedInstance.postMethodAlamofire("api/verifyemail", dictionary: ["userid":userid], withHud: false) { [self] (success, response, error) in
            openAlertPopup(selfVc: self, alertMessage: "Processing...".localized(), showAlert: false)
            if success {
                if response!["status"] as! Bool == true {
                    
//                    self.activityIndicator.stopAnimating()
                    if let timer = self.timer {
                        timer.invalidate()
                        self.timer = nil
                        self.btnRequestResendOtp.isHidden = true
                    }
                    DispatchQueue.main.async {
                        self.moveToSuccess()
                    }
                    
                    
                }else{
                    showDefaultAlert(viewController: self, title: "Message".localized(), msg: "Verifcation Failed".localized())
                }
            }else{
                showDefaultAlert(viewController: self, title: "Message".localized(), msg: "Verifcation Failed".localized())
            }
        }
    }
    
    func moveToSuccess(){
        DispatchQueue.main.asyncAfter(deadline: .now() + 0.5) {
            let nextVC = UIStoryboard(name: "Profile", bundle: Bundle.main).instantiateViewController(withIdentifier: "VerifiedResetViewController") as! VerifiedResetViewController
            nextVC.verificationFrom = VerificationSuccessFrom.signUp
            self.navigationController?.pushViewController(nextVC, animated: true)
        }
    }
}

extension ConfirmationCodeViewController {

    func resendOtp(emailID:String)  {
        openAlertPopup(selfVc: self, alertMessage: "Processing...".localized(), showAlert: true)
        ServiceManager.sharedInstance.postMethodAlamofire("api/resendotp", dictionary: ["email":emailID], withHud: false) { [self] (success, response, error) in
            if success {
                openAlertPopup(selfVc: self, alertMessage: "", showAlert: false)
                if response!["status"] as! Bool == true {
                    if let otp = response!["otp"] as? Int {
                        otpValue = otp
                        startOtpTimer()
                    }
                }else{
                    showDefaultAlert(viewController: self, title: "Message".localized(), msg: "Failed...!")
                }
            }else{
                showDefaultAlert(viewController: self, title: "Message".localized(), msg: "Failed...!")
            }
        }
    }
}



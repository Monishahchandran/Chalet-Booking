//
//  ChangePasswordTVC.swift
//  AbyChaletApp
//
//  Created by Visakh Srishti on 25/05/21.
//

import UIKit
import SkyFloatingLabelTextField

class ChangePasswordTVC: UITableViewController {

    @IBOutlet weak var txtFldCurrentPassword: SkyFloatingLabelTextField!
    @IBOutlet weak var txtFldNewPassword: SkyFloatingLabelTextField!
    @IBOutlet weak var txtFldConfirmPasswrd: SkyFloatingLabelTextField!
    @IBOutlet weak var viewUpdateBtn: UIView!
    @IBOutlet weak var btnUpdate: UIButton!

    override func viewDidLoad() {
        super.viewDidLoad()

        self.setUpNavigationBar()
        self.setupUI()
        NotificationCenter.default.addObserver(self, selector: #selector(logoutUser), name: NSNotification.Name(rawValue: NotificationNames.kBlockedUser), object: nil)
    }
    @objc func logoutUser() {
        appDelegate.logOut()
    }
    override func viewWillAppear(_ animated: Bool) {
        appDelegate.checkBlockStatus()
    }
    override func viewWillDisappear(_ animated: Bool) {
        viewUpdateBtn.removeFromSuperview()
    }
    
    //MARK:- SetupUI
    func setupUI()  {
        [txtFldCurrentPassword, txtFldNewPassword, txtFldConfirmPasswrd].forEach { (skyFloatingTextField) in
            skyFloatingTextField?.lineView.isHidden = true
            if kCurrentLanguageCode == "ar"{
                skyFloatingTextField?.titleFont = UIFont(name: kFontAlmaraiRegular, size: 15)!
                skyFloatingTextField?.placeholderFont = UIFont(name: kFontAlmaraiRegular, size: 15)!
                skyFloatingTextField?.font = UIFont(name: kFontAlmaraiRegular, size: 15)!
                skyFloatingTextField?.titleFormatter = { (text: String) -> String in
                    return text
                }
                
            }else{
                skyFloatingTextField?.titleFont = UIFont(name: "Roboto-Medium", size: 15)!
                skyFloatingTextField?.placeholderFont = UIFont(name: "Roboto-Medium", size: 15)!
                skyFloatingTextField?.font = UIFont(name: "Roboto-Medium", size: 15)!
                skyFloatingTextField?.titleFormatter = { (text: String) -> String in
                    return text
                }
            }
            
        }
        if kCurrentLanguageCode == "ar"{
            btnUpdate.titleLabel?.font = UIFont(name: kFontAlmaraiBold, size: 20)!
            txtFldCurrentPassword.placeholder = "Email Address".localized()
            txtFldNewPassword.placeholder = "Password".localized()
            txtFldConfirmPasswrd.placeholder = "Confirm Password".localized()
            txtFldCurrentPassword.selectedTitle = "Email Address".localized()
            txtFldNewPassword.selectedTitle = "Password".localized()
            txtFldConfirmPasswrd.selectedTitle = "Confirm Password".localized()
            self.btnUpdate.setTitle("Update".localized(), for: .normal)

        }else{
            btnUpdate.titleLabel?.font = UIFont(name: "Arial Bold", size: 20)!

        }
        viewUpdateBtn.frame = CGRect(x: 0, y: kScreenHeight - 130, width: kScreenWidth, height: 130)
        appDelegate.window?.addSubview(viewUpdateBtn)
    }
    
    //MARK:- SetUp NavigationBar
    func setUpNavigationBar() {
        self.navigationController?.navigationBar.isHidden = false
        self.navigationController?.navigationBar.isTranslucent = false

        self.navigationController?.navigationBar.barTintColor = kAppThemeColor
        self.navigationItem.setHidesBackButton(true, animated: true)
        let backBarButton = UIBarButtonItem(image: Images.kIconBackGreen, style: .plain, target: self, action: #selector(backButtonTouched))
        self.navigationItem.leftBarButtonItems = [backBarButton]
        let notificationButton = UIBarButtonItem(image: Images.kIconNotification, style: .plain, target: self, action: #selector(notificationButtonTouched))
        self.navigationItem.rightBarButtonItems = [notificationButton]
        self.navigationItem.title = "Change Password".localized()
        self.navigationController?.navigationBar.titleTextAttributes = [NSAttributedString.Key.foregroundColor: UIColor.white]

    }
    
    //MARK:- ButtonActions
    //MARK:- Done button action keyboard
    @objc func doneButtonClicked() {
        self.view.endEditing(true)
    }
    @objc func backButtonTouched()  {
        self.navigationController?.popViewController(animated: true)
    }
    @objc func notificationButtonTouched()  {
        
        
    }
    @IBAction func btnUpdateDidTap(_ sender: UIButton) {
        if txtFldCurrentPassword.hasText && txtFldNewPassword.hasText && txtFldConfirmPasswrd.hasText {
            if CAUser.currentUser.password == txtFldCurrentPassword.text {
                if txtFldConfirmPasswrd.text == txtFldNewPassword.text {
                    self.resetPassword(emailID: CAUser.currentUser.email!, password: txtFldNewPassword.text!)
                }else{
                    showDefaultAlert(viewController: self, title: "Message".localized(), msg: "Your password and confirmation password do not match".localized())
                }
            }else{
                showDefaultAlert(viewController: self, title: "Message".localized(), msg: "The old password you have entered is incorrect".localized())
            }
        }else{
            showDefaultAlert(viewController: self, title: "Message".localized(), msg: "Please fill all the fields".localized())
        }
    }
}
extension ChangePasswordTVC {
    
    func resetPassword(emailID:String,password:String)  {
        let type = CAUser.currentUser.userstatus == "owner" ? "owner" : "user"
        ServiceManager.sharedInstance.postMethodAlamofire("api/resetpassword", dictionary: ["email":emailID,"new_password":password,"type":type], withHud: true) { (success, response, error) in
            if success {
                if response!["status"] as! Bool == true {
                    DispatchQueue.main.async {
                        self.viewProfile()
                    }
                }else{
                    showDefaultAlert(viewController: self, title: "", msg: response!["message"] as! String)
                }
            }else{
                showDefaultAlert(viewController: self, title: "", msg: "Failed..!")
            }
        }
    }
    
    func viewProfile()  {
        let type = CAUser.currentUser.userstatus == "owner" ? "owner" : "user"
        ServiceManager.sharedInstance.postMethodAlamofire("api/view_profile", dictionary: ["userid":CAUser.currentUser.id!,"type":type], withHud: true) { (success, response, error) in
            if success {
                if response!["status"] as! Bool == true {
                    DispatchQueue.main.async {
                        let userDict = ((response as! NSDictionary)["user_details"] as! NSDictionary)
                        CAUser.currentUser.initWithDictionary(userDictionary: userDict)
                        CAUser.saveLoggedUserdetails(dictDetails: userDict)
                        self.showAlert()
                    }
                }else{
                    showDefaultAlert(viewController: self, title: "", msg: response!["message"] as! String)
                }
            }else{
                showDefaultAlert(viewController: self, title: "", msg: "Failed..!")
            }
        }
    }
    
    func showAlert()  {
        let alert = UIAlertController(title: "Success".localized(), message: "Your password has been reset successfully".localized(), preferredStyle: .alert)
        alert.addAction(UIAlertAction(title: "OK".localized(), style: .default, handler: { action in
            self.navigationController?.popViewController(animated: true)
        }))
        self.present(alert, animated: true, completion: nil)
        
    }
}

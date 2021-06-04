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
    override func viewDidLoad() {
        super.viewDidLoad()

        self.setUpNavigationBar()
        self.setupUI()
    }
    
    override func viewWillDisappear(_ animated: Bool) {
        viewUpdateBtn.removeFromSuperview()
    }
    
    //MARK:- SetupUI
    func setupUI()  {
        [txtFldCurrentPassword, txtFldNewPassword, txtFldConfirmPasswrd].forEach { (skyFloatingTextField) in
            skyFloatingTextField?.lineView.isHidden = true
            skyFloatingTextField?.titleFont = UIFont(name: "Roboto-Medium", size: 15)!
            skyFloatingTextField?.placeholderFont = UIFont(name: "Roboto-Medium", size: 15)!
            skyFloatingTextField?.font = UIFont(name: "Roboto-Medium", size: 15)!
            skyFloatingTextField?.titleFormatter = { (text: String) -> String in
                return text
            }
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
        self.navigationItem.title = "Change Password"
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
                    showDefaultAlert(viewController: self, title: "Message", msg: "Your password and confirmation password do not match")
                }
            }else{
                showDefaultAlert(viewController: self, title: "Message", msg: "The old password you have entered is incorrect")
            }
        }else{
            showDefaultAlert(viewController: self, title: "", msg: "Please fill all the fields")
        }
    }
}
extension ChangePasswordTVC {
    
    func resetPassword(emailID:String,password:String)  {
        ServiceManager.sharedInstance.postMethodAlamofire("api/resetpassword", dictionary: ["email":emailID,"new_password":password], withHud: true) { (success, response, error) in
            if success {
                if response!["status"] as! Bool == true {
                    DispatchQueue.main.async {
                        showDefaultAlert(viewController: self, title: "Success", msg: "Your password has been reset successfully")
                    }
                }else{
                    showDefaultAlert(viewController: self, title: "", msg: response!["message"] as! String)
                }
            }else{
                showDefaultAlert(viewController: self, title: "", msg: "Failed..!")
            }
        }
    }
    
}

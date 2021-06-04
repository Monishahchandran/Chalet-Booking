//
//  VerifiedResetViewController.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 04/05/21.
//

import UIKit

class VerifiedResetViewController: UIViewController {
    @IBOutlet weak var lblDescription: UILabel!
    
    @IBOutlet weak var btnLogin: UIButton!
    @IBOutlet weak var lblAlertTitle: UILabel!
    var verificationFrom:VerificationSuccessFrom?
    override func viewDidLoad() {
        super.viewDidLoad()
        if verificationFrom == VerificationSuccessFrom.forgotPassword {
            setUpForNavigationController(navigationBarTitle: "Completed".localized())
            lblAlertTitle.text = "Reset successfully".localized()
            lblDescription.text = "Your password has been changed".localized()
        }else {
            setUpForNavigationController(navigationBarTitle: "Verification".localized())
            lblAlertTitle.text = "Verified successfully".localized()
            lblDescription.text = "Your Account has been Verified".localized()
        }
        btnLogin.setTitle("Login".localized(), for: .normal)
    }
    
    func setUpForNavigationController(navigationBarTitle:String){
        self.navigationController?.navigationBar.isHidden = false
        navigationController?.navigationBar.barTintColor = #colorLiteral(red: 0.1176470588, green: 0.262745098, blue: 0.3333333333, alpha: 1)
        navigationItem.title = navigationBarTitle
        self.navigationController?.navigationBar.tintColor = #colorLiteral(red: 0.2862745098, green: 1, blue: 0, alpha: 1)
        let attrs = [
            NSAttributedString.Key.foregroundColor: UIColor.white,
            NSAttributedString.Key.font: UIFont(name: "Roboto-Bold", size: 22)!
        ]
        self.navigationController?.navigationBar.titleTextAttributes = attrs
        self.navigationItem.setHidesBackButton(true, animated: true)
        
    }

override func viewWillAppear(_ animated: Bool) {
    super.viewWillAppear(animated)
    self.tabBarController?.tabBar.isHidden = true

}
    
    override func viewDidLayoutSubviews() {
        super.viewDidLayoutSubviews()
        btnLogin.addCorner()
        btnLogin.addBorder()
    }

    @IBAction func btnLoginDidTap(_ sender: Any) {
        if verificationFrom == VerificationSuccessFrom.forgotPassword {
            let storyboard = UIStoryboard.init(name: "Main", bundle: nil)
            let loginScreen = storyboard.instantiateViewController(withIdentifier: "CustomTabbarController") as! CustomTabbarController
            loginScreen.selectedIndex = 3
            appDelegate.window?.rootViewController = loginScreen
        }else {
            redirectingToHomeScreen()
        }
        
       
        
//        let nextVC = UIStoryboard(name: "Profile", bundle: Bundle.main).instantiateViewController(identifier: "LoginSignUpViewController") as! LoginSignUpViewController
//        let appDelegate = UIApplication.shared.delegate as! AppDelegate
//        appDelegate.window?.rootViewController = nextVC
        
    }
}

//
//  AddNewChaletVC.swift
//  AbyChaletApp
//
//  Created by Visakh Srishti on 07/06/21.
//

import UIKit
import WebKit
import SVProgressHUD

class AddNewChaletVC: UIViewController,WKUIDelegate,WKNavigationDelegate {

    
    @IBOutlet var webView: WKWebView!
    var UrlString = "https://web.sicsglobal.com/aby_chalet/adminmail"
    override func viewDidLoad() {
        super.viewDidLoad()

        self.setUpNavigationBar()
        
        SVProgressHUD.show()
        webView.navigationDelegate = self
        webView.uiDelegate = self
        let request = URLRequest(url: URL(string: UrlString)!)
        webView.load(request)
        
        NotificationCenter.default.addObserver(self, selector: #selector(logoutUser), name: NSNotification.Name(rawValue: NotificationNames.kBlockedUser), object: nil)
    }
    
    override func viewWillAppear(_ animated: Bool) {
        appDelegate.checkBlockStatus()
    }
    
    
    @objc func logoutUser() {
        appDelegate.logOut()
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
        self.navigationItem.title = ""
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
    

    func webView(_ webView: WKWebView, didFinish navigation: WKNavigation!) {
        SVProgressHUD.dismiss()
    }
    
    func webView(_ webView: WKWebView, didFail navigation: WKNavigation!, withError error: Error) {
        print(error)
        SVProgressHUD.dismiss()
    }

}

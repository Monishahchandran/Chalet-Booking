//
//  NotificationVC.swift
//  AbyChaletApp
//
//  Created by Visakh Srishti on 30/05/21.
//

import UIKit

class NotificationVC: UIViewController {

    @IBOutlet weak var btnMessages: UIButton!
    @IBOutlet weak var btnInbox: UIButton!
    @IBOutlet weak var viewContainer: UIView!
    override func viewDidLoad() {
        super.viewDidLoad()

        self.setUpNavigationBar()
        
        NotificationCenter.default.addObserver(self, selector: #selector(logoutUser), name: NSNotification.Name(rawValue: NotificationNames.kBlockedUser), object: nil)
    }
    
    @objc func logoutUser() {
        appDelegate.logOut()
    }
    override func viewWillAppear(_ animated: Bool) {
        self.didSetInboxVC()
        appDelegate.checkBlockStatus()
        
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
        self.navigationItem.title = "Notifications"
        self.navigationController?.navigationBar.titleTextAttributes = [NSAttributedString.Key.foregroundColor: UIColor.white]

        
    }
    //MARK:- ButtonActions
    //MARK:- Done button action keyboard
    @objc func doneButtonClicked() {
        self.view.endEditing(true)
    }
    @objc func notificationButtonTouched()  {
        
        
    }
    @objc func backButtonTouched()  {
        self.navigationController?.popViewController(animated: true)
    }
    @IBAction func btnSwitchActions(_ sender: UIButton) {
        switch sender.tag {
        case 0:
            self.didSetInboxVC()
        case 1:
            self.didSetMessageVC()
        default:
            self.didSetInboxVC()

        }
    }

    //MARK:- Remove Child ViewControllers
    func removeChildVC() {
        if self.children.count > 0{
            let viewControllers:[UIViewController] = self.children
            for viewContoller in viewControllers{
                viewContoller.willMove(toParent: nil)
                viewContoller.view.removeFromSuperview()
                viewContoller.removeFromParent()
            }
        }
    }
    //MARK:- SetInboxVC
    func didSetInboxVC()
    {
        self.removeChildVC()
        let inboxVC = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(identifier: "InboxVC") as! InboxVC
        self.addChild(inboxVC)
        inboxVC.view.frame = viewContainer.bounds
        viewContainer.addSubview(inboxVC.view)
        inboxVC.didMove(toParent: self)
        btnInbox.titleLabel?.font = UIFont(name: "Roboto-Medium", size: 16.0)
        btnMessages.titleLabel?.font = UIFont(name: "Roboto-Regular", size: 16.0)
        btnInbox.isSelected = true
        btnMessages.isSelected = false
    }
    //MARK:- SetMessagesVC
    func didSetMessageVC()
    {
        self.removeChildVC()
        let messagesVC = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(identifier: "MessagesVC") as! MessagesVC
        self.addChild(messagesVC)
        messagesVC.view.frame = viewContainer.bounds
        viewContainer.addSubview(messagesVC.view)
        messagesVC.didMove(toParent: self)
        btnInbox.titleLabel?.font = UIFont(name: "Roboto-Regular", size: 16.0)
        btnMessages.titleLabel?.font = UIFont(name: "Roboto-Medium", size: 16.0)
        btnInbox.isSelected = false
        btnMessages.isSelected = true
    }

}

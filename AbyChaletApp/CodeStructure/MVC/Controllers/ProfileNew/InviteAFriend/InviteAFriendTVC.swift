//
//  InviteAFriendTVC.swift
//  AbyChaletApp
//
//  Created by Visakh Srishti on 25/05/21.
//

import UIKit
import MessageUI

class InviteAFriendTVC: UITableViewController {

    var inviteFriendUrl = ""
    override func viewDidLoad() {
        super.viewDidLoad()

        self.setUpNavigationBar()
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
        self.navigationItem.title = "Invite Friend"
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
  
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath){
        if indexPath.row == 0{
            if inviteFriendUrl != "" {
                let message = inviteFriendUrl
                var queryCharSet = NSCharacterSet.urlQueryAllowed
                queryCharSet.remove(charactersIn: "+&")
                if let escapedString = message.addingPercentEncoding(withAllowedCharacters: queryCharSet) {
                    if let whatsappURL = URL(string: "whatsapp://send?text=\(escapedString)") {
                        if UIApplication.shared.canOpenURL(whatsappURL) {
                            UIApplication.shared.open(whatsappURL, options: [: ], completionHandler: nil)
                        } else {
                            debugPrint("please install WhatsApp")
                        }
                    }
                }
            }
        }else if indexPath.row == 1{
            if inviteFriendUrl != "" {
                if (MFMessageComposeViewController.canSendText()) {
                    let controller = MFMessageComposeViewController()
                    controller.body = inviteFriendUrl
                    controller.messageComposeDelegate = self
                    self.present(controller, animated: true, completion: nil)
                }
            }
        }else if indexPath.row == 2{
            if inviteFriendUrl != "" {
                let activityController = UIActivityViewController(activityItems: [inviteFriendUrl], applicationActivities: nil)
                activityController.excludedActivityTypes = [
                    UIActivity.ActivityType.assignToContact,
                    UIActivity.ActivityType.print,
                    UIActivity.ActivityType.addToReadingList,
                    UIActivity.ActivityType.saveToCameraRoll,
                    UIActivity.ActivityType.openInIBooks,
                    UIActivity.ActivityType(rawValue: "com.apple.reminders.RemindersEditorExtension"),
                    UIActivity.ActivityType(rawValue: "com.apple.mobilenotes.SharingExtension"),
                ]
                present(activityController, animated: true, completion: nil)
                
            }
        }
    }

}
extension InviteAFriendTVC : MFMessageComposeViewControllerDelegate {
    
    func messageComposeViewController(_ controller: MFMessageComposeViewController, didFinishWith result: MessageComposeResult) {
        self.dismiss(animated: true, completion: nil)
    }
}

//
//  MyProfileTableVC.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 18/05/21.
//

import UIKit
import SDWebImage

class MyProfileTableVC: UITableViewController {
   
    //MARK: cellProfile
    @IBOutlet weak var imgViewForProfile: UIImageView!
    @IBOutlet weak var lblForUserName: UILabel!
    @IBOutlet weak var lblForMobileNum: UILabel!
    @IBOutlet weak var lblForEmailId: UILabel!
     
    
    @IBOutlet weak var btnForMyAccount: UIButton!
    @IBOutlet weak var lblForMyAccount: UILabel!
    
    @IBOutlet weak var btnForChangePassword: UIButton!
    @IBOutlet weak var lblChangePassword: UILabel!
    
    @IBOutlet weak var btnNotification: UIButton!
    @IBOutlet weak var lblNotification: UILabel!
    
    @IBOutlet weak var lblInviteFriends: UILabel!
    @IBOutlet weak var btnInviteFriends: UIButton!
    
    @IBOutlet weak var btnContactUs: UIButton!
    @IBOutlet weak var lblContactUs: UILabel!
    
    @IBOutlet weak var btnShareApp: UIButton!
    @IBOutlet weak var lblForShareApp: UILabel!
    
    @IBOutlet weak var btnAddChalet: UIButton!
    @IBOutlet weak var lblForAddChalet: UILabel!
    
    @IBOutlet weak var btnInstaGram: UIButton!
    @IBOutlet weak var btnLogOut: UIButton!
    @IBOutlet weak var btnLegalPrivacy: UIButton!
    @IBOutlet weak var viewForTopUserDetails: UIView!
    @IBOutlet weak var imgViewProfilePic: UIImageView!

    @IBOutlet weak var viewForBottomAddYourChalet: UIView!
    
    var arrayAdminDetails = [Admin_details]()
    override func viewDidLoad() {
        super.viewDidLoad()
        self.getAdminDetails()
    }
    
    override func viewWillAppear(_ animated: Bool) {
        self.setValuesToFields()
        
    }
    
    override func viewDidLayoutSubviews() {
        super.viewDidLayoutSubviews()
        viewForTopUserDetails.roundCorners(corners: [.topLeft, .topRight], radius: 10.0)
        viewForBottomAddYourChalet.roundCorners(corners: [.bottomLeft, .bottomRight], radius: 10.0)
    }
    
    @IBAction func btnForMyAccountDidTap(_ sender: Any) {
        let myAccountTVC = UIStoryboard(name: "ProfileNew", bundle: Bundle.main).instantiateViewController(identifier: "MyAccountTVC") as! MyAccountTVC
        navigationController?.pushViewController(myAccountTVC, animated: true)
        
    }
    
    @IBAction func btnChangePasswordDidTap(_ sender: Any) {
        let changePasswordTVC = UIStoryboard(name: "ProfileNew", bundle: Bundle.main).instantiateViewController(identifier: "ChangePasswordTVC") as! ChangePasswordTVC
        navigationController?.pushViewController(changePasswordTVC, animated: true)
    }
    
    @IBAction func btnNotificationDidTap(_ sender: Any) {
        let changePasswordTVC = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(identifier: "NotificationVC") as! NotificationVC
        navigationController?.pushViewController(changePasswordTVC, animated: true)
    }
    
    @IBAction func btnInviteFriendDidTap(_ sender: Any) {
        let changePasswordTVC = UIStoryboard(name: "ProfileNew", bundle: Bundle.main).instantiateViewController(identifier: "InviteAFriendTVC") as! InviteAFriendTVC
        if arrayAdminDetails.count > 0{
            changePasswordTVC.inviteFriendUrl = (arrayAdminDetails.first?.invite_friend!)!
        }
        navigationController?.pushViewController(changePasswordTVC, animated: true)
    }
    
    @IBAction func btnContactUsDidTap(_ sender: Any) {
        let contactUSVC = UIStoryboard(name: "ProfileNew", bundle: Bundle.main).instantiateViewController(identifier: "ContactUSVC") as! ContactUSVC
        navigationController?.pushViewController(contactUSVC, animated: true)
    }
    
    @IBAction func btnShareDidTap(_ sender: Any) {
        if let name = URL(string: "https://itunes.apple.com/us/app/myapp/idxxxxxxxx?ls=1&mt=8"), !name.absoluteString.isEmpty {
            let objectsToShare = [name]
            let activityVC = UIActivityViewController(activityItems: objectsToShare, applicationActivities: nil)
            self.present(activityVC, animated: true, completion: nil)
        } else {
            // show alert for not available
        }
    }
    
    @IBAction func btnAddChaletDidTap(_ sender: Any) {
        guard let url = URL(string: "https://web.sicsglobal.com/aby_chalet/adminmail") else { return }
        UIApplication.shared.open(url)
    }
    
    @IBAction func btnInstagramDidTap(_ sender: Any) {
        
        if self.arrayAdminDetails.count > 0 {
            let Username =  self.arrayAdminDetails.first!.insta_url! // Your Instagram Username here
            let appURL = URL(string: "instagram://user?username=\(Username)")!
            let application = UIApplication.shared
            if application.canOpenURL(appURL) {
                application.open(appURL)
            } else {
                // if Instagram app is not installed, open URL inside Safari
                let webURL = URL(string: "https://instagram.com/\(Username)")!
                application.open(webURL)
            }
        }
    }
    
    @IBAction func btnLogOutDidTap(_ sender: Any) {
        
        let alert = UIAlertController(title: "Message", message: "Are you sure you want to logout?".localized(), preferredStyle: .alert)
        alert.addAction(UIAlertAction(title: "OK", style: .default, handler: { action in
            UserDefaults.standard.removeObject(forKey: "kCurrentUserDetails")
            appDelegate.logOut()
        }))
        alert.addAction(UIAlertAction(title: "Cancel", style: .default, handler: { action in
            
        }))
        self.present(alert, animated: true, completion: nil)
    }
    
    @IBAction func btnLegalPrivacyDidTap(_ sender: Any) {
        
        if self.arrayAdminDetails.count > 0 {
            let termsAndConditionsVC = UIStoryboard(name: "ProfileNew", bundle: Bundle.main).instantiateViewController(identifier: "TermsAndConditionVC") as! TermsAndConditionVC
            termsAndConditionsVC.UrlString = self.arrayAdminDetails.first!.terms_url!
            let vc = UINavigationController(rootViewController: termsAndConditionsVC)
            self.present(vc, animated: true, completion: nil)
        }
    }
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        
        if indexPath.row == 1 {
            if CAUser.currentUser.userstatus == "owner" {
                return super.tableView(tableView, heightForRowAt: indexPath)
            }else{
                return 0
            }
        }
        
        return super.tableView(tableView, heightForRowAt: indexPath)
    }
    
}
// MARK: - Table view data source
extension MyProfileTableVC {
   
    func setValuesToFields() {
        self.imgViewForProfile.image = #imageLiteral(resourceName: "Icn_UserProfileImage")
        self.lblForUserName.text = "\(CAUser.currentUser.first_name!) \(CAUser.currentUser.last_name!)"
        self.lblForMobileNum.text = CAUser.currentUser.phone!
        self.lblForEmailId.text = CAUser.currentUser.email!
        
        if CAUser.currentUser.profile_pic != nil{
            if CAUser.currentUser.profile_pic != "" {
                self.imgViewProfilePic.sd_setImage(with: URL(string: CAUser.currentUser.profile_pic!), placeholderImage: kPlaceHolderImage, options: .highPriority) { image, error, cache, url in
                    if image != nil{
                        self.imgViewProfilePic.image = image
                    }else{
                        self.imgViewProfilePic.image = CAUser.currentUser.gender == "Female" ? kFemalePlaceHolderImage : kMalePlaceHolderImage
                    }
                }
            }else{
                self.imgViewProfilePic.image = CAUser.currentUser.gender == "Female" ? kFemalePlaceHolderImage : kMalePlaceHolderImage
            }
           
        }else{
            self.imgViewProfilePic.image = CAUser.currentUser.gender == "Female" ? kFemalePlaceHolderImage : kMalePlaceHolderImage
        }
    }
}
extension MyProfileTableVC {
    
    
    func getAdminDetails() {
        ServiceManager.sharedInstance.postMethodAlamofire("api/view_admin", dictionary: nil, withHud: true) { [self] (success, response, error) in
            if success {
                if response!["status"] as! Bool == true {
                    
                    let jsonBase = AdminDetailsBase(dictionary: response as! NSDictionary)
                    self.arrayAdminDetails = (jsonBase?.admin_details)!
                    
                }else{
                    showDefaultAlert(viewController: self, title: "Message".localized(), msg: "Failed...!")
                }
            }else{
                showDefaultAlert(viewController: self, title: "Message".localized(), msg: error!.localizedDescription)
            }
        }
    }
    
    
    
}

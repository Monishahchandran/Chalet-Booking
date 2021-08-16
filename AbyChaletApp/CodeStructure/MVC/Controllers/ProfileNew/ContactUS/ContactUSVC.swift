//
//  ContactUSVC.swift
//  AbyChaletApp
//
//  Created by Visakh Srishti on 25/05/21.
//

import UIKit

class ContactUSVC: UIViewController {
    
    var arrayContactList = [Contact_list]()

    @IBOutlet weak var collectionViewContact: UICollectionView!
    override func viewDidLoad() {
        super.viewDidLoad()

        self.setUpNavigationBar()
        self.setupUI()
        self.getContactList()
        NotificationCenter.default.addObserver(self, selector: #selector(logoutUser), name: NSNotification.Name(rawValue: NotificationNames.kBlockedUser), object: nil)
    }
    @objc func logoutUser() {
        appDelegate.logOut()
    }
    
    //MARK:- SetupUI
    func setupUI() {
        
        let width = kScreenWidth - 24
        let columnLayout = ColumnFlowLayout.init(cellsPerRow: 1, minimumInteritemSpacing: 0.0, minimumLineSpacing: 0.0, sectionInset: UIEdgeInsets(top: 8, left: 8, bottom: 0, right: 8), cellHeight: 200, cellWidth: width / 2,scrollDirec: .vertical)
        collectionViewContact?.collectionViewLayout = columnLayout
        
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
        self.navigationItem.title = "Contact Us"
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

}
extension ContactUSVC : UICollectionViewDelegate, UICollectionViewDataSource{
    
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        return arrayContactList.count
    }
    
    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        
        let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "ContactUsCollectionViewCell", for: indexPath) as! ContactUsCollectionViewCell
        cell.setValuesToFieldes(dictContact: arrayContactList[indexPath.row])
        return cell
    }
    
    func collectionView(_ collectionView: UICollectionView, didSelectItemAt indexPath: IndexPath) {
        if arrayContactList.count > 0 {
            let urlWhats = "whatsapp://send?phone=\(arrayContactList[indexPath.row].phone!)"
            if let urlString = urlWhats.addingPercentEncoding(withAllowedCharacters: NSCharacterSet.urlQueryAllowed) {
                if let whatsappURL = URL(string: urlString) {
                    if UIApplication.shared.canOpenURL(whatsappURL) {
                        UIApplication.shared.open(whatsappURL, options: [: ], completionHandler: nil)
                    } else {
                        print("Install Whatsapp")
                    }
                }
            }
        }
    }
}
extension ContactUSVC {
    
    func getContactList() {
        ServiceManager.sharedInstance.postMethodAlamofire("api/contact", dictionary: nil, withHud: true) { (success, response, error) in
            if success {
                if response!["status"] as! Bool == true {
                    let responseBase = ContactUsBase(dictionary: response as! NSDictionary)
                    self.arrayContactList = (responseBase?.contact_list)!
                    DispatchQueue.main.async {
                        self.collectionViewContact.reloadData()
                    }
                }else{
                    showDefaultAlert(viewController: self, title: "", msg: ((response as! NSDictionary)["message"] as! String))
                }
            }else{
                showDefaultAlert(viewController: self, title: "", msg: error!.localizedDescription)
            }
        }
    }
    
}

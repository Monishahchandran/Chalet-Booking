//
//  OffersListVC.swift
//  AbyChaletApp
//
//  Created by Visakh Srishti on 27/05/21.
//

import UIKit

class OffersListVC: UIViewController {

    @IBOutlet weak var tableViewOfferList: UITableView!
    
    var arryOfferList = [OfferChalet_list]()
    var dictAdmin = Admin(dictionary: NSDictionary())
    var isLoad = false
    override func viewDidLoad() {
        super.viewDidLoad()
        self.setUpNavigationBar()
    }
    
    
    override func viewWillAppear(_ animated: Bool) {
        super.viewWillAppear(animated)
        /*if CAUser.currentUser.id != nil{
            self.getRewardsData()
        }else {
            self.isLoad = true
        }*/
        
        self.getRewardsData()
        
        NotificationCenter.default.addObserver(self, selector: #selector(logoutUser), name: NSNotification.Name(rawValue: NotificationNames.kBlockedUser), object: nil)
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
        //let backBarButton = UIBarButtonItem(image: Images.kIconBackGreen, style: .plain, target: self, action: #selector(backButtonTouched))
        //self.navigationItem.leftBarButtonItems = [backBarButton]
        let notificationButton = UIBarButtonItem(image: Images.kIconNotification, style: .plain, target: self, action: #selector(notificationButtonTouched))
        self.navigationItem.rightBarButtonItems = [notificationButton]
        self.navigationItem.title = "Offers".localized()
        self.navigationController?.navigationBar.titleTextAttributes = [NSAttributedString.Key.foregroundColor: UIColor.white]

        
    }
    //MARK:- ButtonActions
    //MARK:- Done button action keyboard
    @objc func doneButtonClicked() {
        self.view.endEditing(true)
    }
    @objc func notificationButtonTouched()  {
        
        
    }
    

}
extension OffersListVC : UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        if isLoad == true{
            return  arryOfferList.count != 0 ? arryOfferList.count : 1
        }else{
            return 0
        }
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        
        if self.arryOfferList.count > 0{
            let cell = tableView.dequeueReusableCell(withIdentifier: "OfferListTVCell", for: indexPath) as! OfferListTVCell
            cell.setCollectionViewDataSourceDelegate(self, forRow: indexPath.row, loaded: false)
            cell.setValuesToFields(dictAdmin: dictAdmin!, dict: self.arryOfferList[indexPath.row])
            return cell
        }else{
            let cell = tableView.dequeueReusableCell(withIdentifier: "NoBookingTVCell", for: indexPath) as! NoBookingTVCell
            return cell
            
        }
    }
    
    func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        if self.arryOfferList.count > 0{
            let count = arryOfferList[indexPath.row].offerUser_details!.count
            return CGFloat((count * 155) + 60)
        }else{
            return 174
        }
    }
    
}
extension OffersListVC : UICollectionViewDelegate, UICollectionViewDataSource, UICollectionViewDelegateFlowLayout {
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        return arryOfferList[collectionView.tag].offerUser_details!.count
    }
    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        
        let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "RewardsChaletListCollectionViewCell", for: indexPath) as! RewardsChaletListCollectionViewCell
        cell.setValuesToFields(dict: arryOfferList[collectionView.tag].offerUser_details![indexPath.row])
        return cell
    }
    
    func collectionView(_ collectionView: UICollectionView, didSelectItemAt indexPath: IndexPath) {
        
        print("Section\(collectionView.tag)")
        print("Cell\(indexPath.row)")
        
        
        let reservationVC = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(identifier: "ReservationTVC") as! ReservationTVC
        reservationVC.dictOfferUserDetails = arryOfferList[collectionView.tag].offerUser_details![indexPath.row]
        reservationVC.isFromOffer = true
        reservationVC.dictAdmin = self.dictAdmin
        reservationVC.dictOfferChaletList = self.arryOfferList[collectionView.tag]
        
        //reservationVC.selectedIndex = indexPath.item
        reservationVC.selectedPackage = arryOfferList[collectionView.tag].offerUser_details![indexPath.row].package!
        navigationController?.pushViewController(reservationVC, animated: true)
                
    }
}
extension OffersListVC {
    
    //MARK:- GetMyBookingData
    func getRewardsData() {
       //["userid":CAUser.currentUser.id!]
        ServiceManager.sharedInstance.postMethodAlamofire("api/offers", dictionary: nil, withHud: true) { (success, response, error) in
            self.isLoad = true
            if success {
                if ((response as! NSDictionary) ["status"] as! Bool) == true {
                    let responseBase = OfferListBase(dictionary: response as! NSDictionary)
                    self.dictAdmin = responseBase?.admin
                    self.arryOfferList = (responseBase?.offerChalet_list)!
                    DispatchQueue.main.async {
                        self.isLoad = true
                        self.tableViewOfferList.reloadData()
                    }
                }else{
                    showDefaultAlert(viewController: self, title: "", msg: response!["message"]! as! String)
                }
            }else{
                showDefaultAlert(viewController: self, title: "", msg: "Failed..!")
            }
        }
    }
}

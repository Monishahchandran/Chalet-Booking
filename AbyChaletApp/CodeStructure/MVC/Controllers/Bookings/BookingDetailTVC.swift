//
//  BookingDetailTVC.swift
//  AbyChaletApp
//
//  Created by Visakh Srishti on 04/06/21.
//

import UIKit
import DHSmartScreenshot
import MediaPlayer
import AVKit

class BookingDetailTVC: UITableViewController {

    @IBOutlet weak var lblCollectionIndex: UILabel!
    @IBOutlet weak var viewCollectionIndex: UIView!

    @IBOutlet weak var lblTotalPaid: UILabel!
    @IBOutlet weak var lblDiscount: UILabel!
    @IBOutlet weak var lblRent: UILabel!
    @IBOutlet weak var collectionViewAgrrement: UICollectionView!
    @IBOutlet weak var collectionViewChalletDetails: UICollectionView!
    @IBOutlet weak var lblCheckInTime: UILabel!
    @IBOutlet weak var lblCheckInDate: UILabel!
    @IBOutlet weak var lblCheckOutTime: UILabel!
    @IBOutlet weak var lblCheckOutDate: UILabel!
    @IBOutlet weak var lblChaletId: UILabel!
    @IBOutlet weak var lblChaletName: UILabel!
    @IBOutlet weak var collectionViewChalletImage: UICollectionView!
    @IBOutlet weak var viewChaletHeadingDetails: UIView!
    @IBOutlet weak var viewBgCollectionView: UIView!
    var dictMyBooking : MyBooking_details!
    var arrayAgreements = [Agreement]()
    var collectionIndex = 0
    var lblIndexValue = 1

    override func viewDidLoad() {
        super.viewDidLoad()

        self.setUpNavigationBar()
        self.getAgreementsDetails()
        self.setupUI()
        self.setValuesToFields()
        NotificationCenter.default.addObserver(self, selector: #selector(logoutUser), name: NSNotification.Name(rawValue: NotificationNames.kBlockedUser), object: nil)
    }
    
    @objc func logoutUser() {
        appDelegate.logOut()
    }
    
    override func viewWillAppear(_ animated: Bool) {
        appDelegate.checkBlockStatus()
    }
    
    override func viewDidLayoutSubviews() {
        self.viewChaletHeadingDetails.roundCorners(corners: [.topLeft,.topRight], radius: 10.0)
        self.viewBgCollectionView.roundCorners(corners: [.bottomLeft,.bottomRight], radius: 10.0)
        self.viewCollectionIndex.roundCorners(corners: [.bottomRight], radius: 10.0)

    }

    //MARK:- SetUp NavigationBar
    func setUpNavigationBar() {
        self.navigationController?.navigationBar.isHidden = false
        self.navigationController?.navigationBar.isTranslucent = false

        self.navigationController?.navigationBar.barTintColor = kAppThemeColor
        self.navigationItem.setHidesBackButton(true, animated: true)
        let backBarButton = UIBarButtonItem(image: Images.kIconBackGreen, style: .plain, target: self, action: #selector(backButtonTouched))
        self.navigationItem.leftBarButtonItems = [backBarButton]
        let notificationButton = UIBarButtonItem(image: Images.kIconNotification, style: .plain, target: self, action: #selector(backButtonTouched))
        self.navigationItem.rightBarButtonItems = [notificationButton]
        self.navigationItem.title = ""
        self.navigationController?.navigationBar.titleTextAttributes = [NSAttributedString.Key.foregroundColor: UIColor.white]
    }
    
    //MARK:- SetupUI
    func setupUI()  {
        //let width = kScreenWidth - 200
        
        let width = kScreenWidth - 30
        let columnLayout10 = ColumnFlowLayout.init(cellsPerRow: 1, minimumInteritemSpacing: 0.0, minimumLineSpacing: 0.0, sectionInset: UIEdgeInsets(top: 0, left: 0, bottom: 0, right: 0), cellHeight: 315, cellWidth: width,scrollDirec: .horizontal)
        collectionViewChalletImage?.collectionViewLayout = columnLayout10
        
        
        /*let columnLayout = ColumnFlowLayout.init(cellsPerRow: 1, minimumInteritemSpacing: 0.0, minimumLineSpacing: 0.0, sectionInset: UIEdgeInsets(top: 0, left: 0, bottom: 0, right: 0), cellHeight: 315, cellWidth: width,scrollDirec: .horizontal)
        collectionViewImageVideo?.collectionViewLayout = columnLayout*/
        
        let columnLayout1 = ColumnFlowLayout.init(cellsPerRow: 1, minimumInteritemSpacing: 0.0, minimumLineSpacing: 0.0, sectionInset: UIEdgeInsets(top: 0, left: 0, bottom: 0, right: 0), cellHeight: 23, cellWidth: width,scrollDirec: .vertical)
        collectionViewChalletDetails?.collectionViewLayout = columnLayout1
        
        let columnLayout2 = ColumnFlowLayout.init(cellsPerRow: 2, minimumInteritemSpacing: 0.0, minimumLineSpacing: 0.0, sectionInset: UIEdgeInsets(top: 0, left: 0, bottom: 0, right: 0), cellHeight: 35, cellWidth: width,scrollDirec: .vertical)
        collectionViewAgrrement?.collectionViewLayout = columnLayout2
        
    }
    
    //MARK:- setValuesToFields
    func setValuesToFields() {
        
        let dict = dictMyBooking.myBookingChalet_details?.first
        self.lblChaletId.text = "\(String(describing: dict!.chalet_id!))"
        self.lblChaletName.text = dict?.chalet_name!
        self.lblCheckOutDate.text = dictMyBooking.check_out!.appFormattedDate
        self.lblCheckOutTime.text = dictMyBooking.admincheck_out!
        self.lblCheckInDate.text = dictMyBooking.check_in!.appFormattedDate
        self.lblCheckInTime.text = dictMyBooking.admincheck_in!
        self.lblRent.text = "KD \(dictMyBooking.rent!)"
        self.lblDiscount.text = "KD \(dictMyBooking.reward_discount!)"
        self.lblTotalPaid.text = "KD \(dictMyBooking.total_paid!)"
        
        self.lblCollectionIndex.text = "\(lblIndexValue)/\(String(describing: (dictMyBooking.myBookingChalet_details?.first?.chalet_details!.count)!))"
    }
    
    //MARK:- ButtonActions
    //MARK:- Done button action keyboard
    @objc func doneButtonClicked() {
        self.view.endEditing(true)
    }
    @objc func backButtonTouched()  {
        self.navigationController?.popViewController(animated: true)
    }
    @IBAction func btnPrevActionCollectioView(_ sender: Any) {
        
        if collectionIndex != 0 {
            collectionIndex = collectionIndex - 1
            lblIndexValue = lblIndexValue - 1
            self.lblCollectionIndex.text = "\(lblIndexValue)/\(String(describing: (dictMyBooking.myBookingChalet_details?.first?.chalet_upload!.count)!))"
            collectionViewChalletImage.scrollToItem(at: IndexPath(item: collectionIndex, section: 0), at: .centeredHorizontally, animated: true)
            
        }
        
    }
    @IBAction func btnForwardvActionCollectioView(_ sender: Any) {
        
        if collectionIndex != ((dictMyBooking.myBookingChalet_details?.first?.chalet_upload!.count)! - 1) {
            collectionIndex = collectionIndex + 1
            lblIndexValue = lblIndexValue + 1
            self.lblCollectionIndex.text = "\(lblIndexValue)/\(String(describing: (dictMyBooking.myBookingChalet_details?.first?.chalet_upload!.count)!))"
            collectionViewChalletImage.scrollToItem(at: IndexPath(item: collectionIndex, section: 0), at: .centeredHorizontally, animated: true)
            
        }
        
    }
    @IBAction func btnWhatsapAction(_ sender: UIButton) {
        let shareImage = self.tableView.screenshot()
       
        if shareImage != nil {
            
            let activityController = UIActivityViewController(activityItems: [shareImage!], applicationActivities: nil)
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
    
    @IBAction func btnPlayVideoAction(_ sender: UIButton) {
        
        let urlStr =  dictMyBooking.myBookingChalet_details?.first?.chalet_upload![sender.tag].file_name!
           // self.showPlayerPopup(videourl: urlStr)
        let videoUrl = URL(string: urlStr!.addingPercentEncoding(withAllowedCharacters: .urlFragmentAllowed)!)!
            let player = AVPlayer(url: videoUrl)
            let playerViewController = AVPlayerViewController()
            playerViewController.player = player
            self.present(playerViewController, animated: true) {
                playerViewController.player!.play()
            }
        
    }
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        if indexPath.row == 4 {
            let arrayHeight = arrayAgreements.count * 35
            return CGFloat(98 + arrayHeight)
            
        }else if indexPath.row == 3 {
            let arrayHeight = (dictMyBooking.myBookingChalet_details?.first?.chalet_details!.count)! * 23
            return CGFloat(57 + arrayHeight)
            
        }else{
            
            return super.tableView(tableView, heightForRowAt: indexPath)
        }
    }
    
}
extension BookingDetailTVC : UICollectionViewDelegate, UICollectionViewDataSource{
    
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        if collectionView.tag == 1 {
            return (dictMyBooking.myBookingChalet_details?.first?.chalet_upload!.count)!
        }else if collectionView.tag ==  2 {
            return (dictMyBooking.myBookingChalet_details?.first?.chalet_details!.count)!
        }else if collectionView.tag ==  3 {
            return self.arrayAgreements.count
        }else{
            return 0
        }
    }
    
    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        
        if collectionView.tag ==  1 {
            
            let arr = dictMyBooking.myBookingChalet_details?.first?.chalet_upload!
            if arr![indexPath.item].file_name!.contains(".jpg"){
                let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "CollectionViewIMageVideoCVCell", for: indexPath) as! CollectionViewIMageVideoCVCell
                DispatchQueue.main.async {
                    cell.imgChaletImage.sd_setImage(with: URL(string: arr![indexPath.item].file_name!), placeholderImage: kPlaceHolderImage, options: .highPriority) { image, error, cache, url in
                        if image != nil {
                            cell.imgChaletImage.image = image
                        }else{
                            cell.imgChaletImage.image = kPlaceHolderImage
                        }
                    }
                }
                return cell
            }else{
                let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "CollectionViewVideoCVCell", for: indexPath) as! CollectionViewVideoCVCell
                cell.playVideo(videourl: arr![indexPath.item].file_name!, previewImage: "")
                cell.btnPlay.tag = indexPath.item
                return cell
            }
            
        }else if collectionView.tag ==  2 {
            let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "CollectionViewChaletDetailsCVCell", for: indexPath) as! CollectionViewChaletDetailsCVCell
            let arr = dictMyBooking.myBookingChalet_details?.first?.chalet_details!
            cell.setValuesToFields(dict: arr![indexPath.item])
            return cell
            
        }else  {
            let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "CollectionViewAgreementCVCell", for: indexPath) as! CollectionViewAgreementCVCell
            let htmlStr = self.arrayAgreements[indexPath.item].agreement_content!
            if let htmlData = htmlStr.data(using: String.Encoding.unicode) {
                do {
                    cell.lblAgreement.attributedText = try NSAttributedString(data: htmlData,options: [.documentType:NSAttributedString.DocumentType.html],documentAttributes: nil)
                } catch let e as NSError {
                    print("Couldn't translate \(htmlStr): \(e.localizedDescription) ")
                    cell.lblAgreement.text = self.arrayAgreements[indexPath.item].agreement_content!
                }
            }
            return cell
            
        }
    }
}
extension BookingDetailTVC {
    func getAgreementsDetails() {
        ServiceManager.sharedInstance.postMethodAlamofire("api/agreements", dictionary: nil, withHud: true) { [self] (success, response, error) in
            if success {
                if ((response as! NSDictionary)["status"] as! Bool) == true {
                    
                    let jsonBase = AgreementListBase(dictionary: response as! NSDictionary)
                    self.arrayAgreements = (jsonBase?.agreement)!
                    DispatchQueue.main.async {
                        self.collectionViewAgrrement.reloadData()
                        self.tableView.reloadRows(at: [IndexPath(row: 4, section: 0)], with: .none)
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

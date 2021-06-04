//
//  ReservationTVC.swift
//  AbyChaletApp
//
//  Created by Visakh Srishti on 15/05/21.
//

import UIKit
import MediaPlayer
import AVKit
import DHSmartScreenshot
import MFSDK
import SVProgressHUD
import GradientProgress

class ReservationTVC: UITableViewController {

    
    @IBOutlet weak var lblDiscountRent: UILabel!
    @IBOutlet weak var lblTotalRent: UILabel!
    @IBOutlet weak var lblTimeProgress: UILabel!
    @IBOutlet weak var viewTopProgress: GradientProgressBar!
    @IBOutlet weak var viewNoDeposit: UIView!
    @IBOutlet weak var lblRemainingDateAndTime: UILabel!
    @IBOutlet weak var lblTotalInvoice: UILabel!
    @IBOutlet weak var lblRewards: UILabel!
    @IBOutlet weak var lblRemainingAmt: UILabel!
    @IBOutlet weak var lblDeposit: UILabel!
    @IBOutlet weak var viewBgCollectionView: UIView!
    @IBOutlet weak var collectionViewNew: UICollectionView!
    @IBOutlet weak var lblAgreement: UILabel!
    @IBOutlet var btnCollection: [UIButton]!
    @IBOutlet weak var viewChalletName: UIView!
    @IBOutlet weak var lblSlNo: UILabel!
    @IBOutlet weak var btnBookingDetailDeposit: UIButton!
    @IBOutlet weak var lblChaletName: UILabel!
    @IBOutlet weak var btnPayment: UIButton!
    @IBOutlet weak var btnAgreement: UIButton!
    @IBOutlet weak var viewCheckOutIn: UIView!
    @IBOutlet weak var viewBookingDetailsBottom: UIView!
    @IBOutlet weak var ViewBookingDetailsHeading: UIView!
    @IBOutlet weak var viewBookingDetails: UIView!
    @IBOutlet weak var viewChalletDetails: UIView!
    @IBOutlet weak var viewChaletHeadingDetails: UIView!
    @IBOutlet weak var collectionViewChalletDetails: UICollectionView!
    @IBOutlet weak var viewAgreement: UIView!
    @IBOutlet weak var viewAgreementHeading: UIView!
    @IBOutlet weak var viewAgreementBottom: UIView!
    @IBOutlet weak var collectionViewAgreement: UICollectionView!
    @IBOutlet weak var viewDeposit: UIView!
    @IBOutlet weak var heightConstrain: NSLayoutConstraint!
    
    @IBOutlet weak var lblCheckOutDate: UILabel!
    @IBOutlet weak var lblCheckInDate: UILabel!
    @IBOutlet weak var lblCheckOutTime: UILabel!
    @IBOutlet weak var lblCheckInTime: UILabel!
    @IBOutlet weak var lblRent: UILabel!
    
    @IBOutlet weak var viewPrev: UIView!
    @IBOutlet weak var viewForward: UIView!

    var dictBookingDetails = Booking_details(dictionary: NSDictionary())

    var imgArr : [UIImage] = [#imageLiteral(resourceName: "icn_Confirmationcode"),#imageLiteral(resourceName: "IconSelect"),#imageLiteral(resourceName: "img_intro1"),#imageLiteral(resourceName: "img_intro2")]
    var isClickDeposit = false
    var arrayUserDetails = [User_details]()
    var selectedIndex : Int!
    var collectionIndex = 0
    var arrayAgreeMentIdxs = [Int]()
    var isSelectTermsAgreement = false
    var isPaymentEnable = false
    //Payment
    var paymentMethods: [MFPaymentMethod]?
    var selectedPaymentMethodIndex = 4
    //at list one product Required
    let productList = NSMutableArray()
    var selectedPackage = ""
    var isFromOffer = false
    var dictOfferUserDetails : OfferUser_details!
    var dictOfferChaletList : OfferChalet_list!
    var dictAdmin : Admin!
    var arrayAgreements = [Agreement]()

    override func viewDidLoad() {
        super.viewDidLoad()

        self.setUpNavigationBar()
        self.setupUI()
        self.getAgreementsDetails()
        if isFromOffer == true{
            self.setValuesFromOffer(selectIndex: 0)
        }else{
            self.setValuesToFields(selectIndex: selectedIndex)
        }
        
        
        
        
        
        initiatePayment()
    }
    
    override func viewDidLayoutSubviews() {
        self.viewChaletHeadingDetails.roundCorners(corners: [.topLeft,.topRight], radius: 10.0)
        self.viewAgreementHeading.roundCorners(corners: [.topLeft,.topRight], radius: 10.0)
        self.viewAgreementBottom.roundCorners(corners: [.bottomLeft,.bottomRight], radius: 10.0)
        self.viewBookingDetails.roundCorners(corners: [.topLeft,.topRight], radius: 10.0)
        self.viewBookingDetails.roundCorners(corners: [.bottomLeft,.bottomRight], radius: 10.0)
        self.viewChalletName.roundCorners(corners: [.topLeft,.topRight], radius: 10.0)
        self.viewBgCollectionView.roundCorners(corners: [.bottomLeft,.bottomRight], radius: 10.0)
        self.viewPrev.roundCorners(corners: [.topRight,.bottomRight], radius: 8.0)
        self.viewForward.roundCorners(corners: [.topLeft,.bottomLeft], radius: 8.0)
        //layer.cornerRadius = 10.0
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
        self.navigationItem.title = "Reservation"
        self.navigationController?.navigationBar.titleTextAttributes = [NSAttributedString.Key.foregroundColor: UIColor.white]
        self.heightConstrain.constant = 0
        self.viewDeposit.isHidden = true
    }
    
    //MARK:- SetupUI
    func setupUI()  {
        //let width = kScreenWidth - 200
        
        let width = kScreenWidth - 30
        let columnLayout10 = ColumnFlowLayout.init(cellsPerRow: 1, minimumInteritemSpacing: 0.0, minimumLineSpacing: 0.0, sectionInset: UIEdgeInsets(top: 0, left: 0, bottom: 0, right: 0), cellHeight: 315, cellWidth: width,scrollDirec: .horizontal)
        collectionViewNew?.collectionViewLayout = columnLayout10
        
        
        /*let columnLayout = ColumnFlowLayout.init(cellsPerRow: 1, minimumInteritemSpacing: 0.0, minimumLineSpacing: 0.0, sectionInset: UIEdgeInsets(top: 0, left: 0, bottom: 0, right: 0), cellHeight: 315, cellWidth: width,scrollDirec: .horizontal)
        collectionViewImageVideo?.collectionViewLayout = columnLayout*/
        
        let columnLayout1 = ColumnFlowLayout.init(cellsPerRow: 1, minimumInteritemSpacing: 0.0, minimumLineSpacing: 0.0, sectionInset: UIEdgeInsets(top: 0, left: 0, bottom: 0, right: 0), cellHeight: 23, cellWidth: width,scrollDirec: .vertical)
        collectionViewChalletDetails?.collectionViewLayout = columnLayout1
        
        let columnLayout2 = ColumnFlowLayout.init(cellsPerRow: 2, minimumInteritemSpacing: 0.0, minimumLineSpacing: 0.0, sectionInset: UIEdgeInsets(top: 0, left: 0, bottom: 0, right: 0), cellHeight: 35, cellWidth: width,scrollDirec: .vertical)
        collectionViewAgreement?.collectionViewLayout = columnLayout2
        
        self.viewCheckOutIn.addCornerForView(cornerRadius: 10.0)
        self.viewChalletDetails.addCornerForView(cornerRadius: 10.0)
        self.viewBookingDetails.addCornerForView(cornerRadius: 10.0)
        self.viewAgreement.addCornerForView(cornerRadius: 10.0)
        self.btnAgreement.addCornerForView(cornerRadius: 8.0)
        self.btnBookingDetailDeposit.addCornerForView(cornerRadius: 8.0)
        self.btnPayment.addCornerForView(cornerRadius: 27.5)
        self.btnPayment.addBorderForView()
        for btn in btnCollection{
            btn.addCornerForView(cornerRadius: 17.5)
        }
        
        let attrsWhatKindOfJob1 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Regular", size: 15)!, NSAttributedString.Key.foregroundColor : #colorLiteral(red: 1, green: 1, blue: 1, alpha: 1)] as [NSAttributedString.Key : Any]
        let attrsWhatKindOfJob2 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Medium", size: 16)!, NSAttributedString.Key.foregroundColor : #colorLiteral(red: 1, green: 1, blue: 1, alpha: 1)] as [NSAttributedString.Key : Any]
        let attrsWhatKindOfJob3 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Medium", size: 16)!, NSAttributedString.Key.foregroundColor : #colorLiteral(red: 0.9686274529, green: 0.78039217, blue: 0.3450980484, alpha: 1)] as [NSAttributedString.Key : Any]
        
        let attributedStringWhatKindOfJob1 = NSMutableAttributedString(string:"I have read and ", attributes:attrsWhatKindOfJob1)
        let attributedStringWhatKindOfJob2 = NSMutableAttributedString(string:"Agree ", attributes:attrsWhatKindOfJob2)
        let attributedStringWhatKindOfJob3 = NSMutableAttributedString(string:"to the ", attributes:attrsWhatKindOfJob1)
        let attributedStringWhatKindOfJob4 = NSMutableAttributedString(string:"terms ", attributes:attrsWhatKindOfJob3)
        let attributedStringWhatKindOfJob5 = NSMutableAttributedString(string:"of service ", attributes:attrsWhatKindOfJob1)
        
        
        attributedStringWhatKindOfJob1.append(attributedStringWhatKindOfJob2)
        attributedStringWhatKindOfJob1.append(attributedStringWhatKindOfJob3)
        attributedStringWhatKindOfJob1.append(attributedStringWhatKindOfJob4)
        attributedStringWhatKindOfJob1.append(attributedStringWhatKindOfJob5)
        self.lblAgreement.attributedText = attributedStringWhatKindOfJob1
        
    }
    
    //MARK:- setValuesToFields
    func setValuesToFields(selectIndex:Int) {
        self.lblRent.text = "KD \(arrayUserDetails[selectIndex].rent!)"
        self.lblCheckOutDate.text = arrayUserDetails[selectIndex].check_out
        self.lblCheckInDate.text = arrayUserDetails[selectIndex].check_in
        self.lblCheckInTime.text = arrayUserDetails[selectIndex].admincheck_in
        self.lblCheckOutTime.text = arrayUserDetails[selectIndex].admincheck_out
        self.lblSlNo.text = "No. \(arrayUserDetails[selectedIndex].chalet_id ?? 0)"
        self.lblChaletName.text = arrayUserDetails[selectedIndex].chalet_name
        self.lblDeposit.text = "KD \(arrayUserDetails[selectedIndex].min_deposit!)"
        let dateFormater = DateFormatter()
        dateFormater.dateFormat = "yyyy-MM-dd hh:mm a"
        let checkinDate = dateFormater.date(from: "\(String(describing: arrayUserDetails[selectIndex].check_in!)) \(String(describing: arrayUserDetails[selectIndex].admincheck_in!))")
        let difference = Calendar.current.dateComponents([.hour], from: Date(), to: checkinDate!)
        if difference.hour! <= 72 {
            self.viewNoDeposit.isHidden = true
            let totalRent = Double(arrayUserDetails[selectIndex].rent!)
            let minDeposit = Double(arrayUserDetails[selectedIndex].min_deposit!)
            let remainingAmt : Int = Int(totalRent! - minDeposit!)
            self.lblRemainingAmt.text = "KD \(remainingAmt)"
            self.lblTotalInvoice.text = "KD \(arrayUserDetails[selectIndex].rent!)"
            let remaingTimeToPay = Int(arrayUserDetails[selectIndex].remaining_amt_pay!)
            
            let wedDate = Calendar.current.date( byAdding: .hour,value: -remaingTimeToPay!,to: checkinDate!)
            lblRemainingDateAndTime.text = dateFormater.string(from: wedDate!)
        }else{
            self.viewNoDeposit.isHidden = false
            self.lblTotalInvoice.text = "KD \(arrayUserDetails[selectIndex].rent!)"
        }
    }
    //MARK:- setValuesToFields
    func setValuesFromOffer(selectIndex:Int) {
        
        self.lblRent.text = "KD \(dictOfferUserDetails.rent!)"
        self.lblCheckOutDate.text = dictOfferUserDetails.check_out
        self.lblCheckInDate.text = dictOfferUserDetails.check_in
        self.lblCheckInTime.text = dictOfferUserDetails.admincheck_in
        self.lblCheckOutTime.text = dictOfferUserDetails.admincheck_out
        self.lblSlNo.text = "No. \(dictOfferUserDetails.chalet_id ?? 0)"
        self.lblChaletName.text = dictOfferUserDetails.chalet_name
        self.lblDeposit.text = "KD \(dictOfferUserDetails.discount_amt!)"
        
        let attributeString: NSMutableAttributedString =  NSMutableAttributedString(string: "\(dictOfferUserDetails.rent!) KD")
            attributeString.addAttribute(NSAttributedString.Key.strikethroughStyle, value: 2, range: NSMakeRange(0, attributeString.length))
        self.lblTotalRent.attributedText = attributeString
        
        
        let attrsTotalRent1 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Bold", size: 30)!, NSAttributedString.Key.foregroundColor : #colorLiteral(red: 0.2156862745, green: 0.6235294118, blue: 0, alpha: 1)] as [NSAttributedString.Key : Any]
        let attrsTotalRent2 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Medium", size: 25)!, NSAttributedString.Key.foregroundColor : #colorLiteral(red: 0.1176470588, green: 0.262745098, blue: 0.3333333333, alpha: 1)] as [NSAttributedString.Key : Any]
        
        
        let attributedTotalRent1 = NSMutableAttributedString(string:"\(dictOfferUserDetails.discount_amt!) ", attributes:attrsTotalRent1)
        let attributedTotalRent2 = NSMutableAttributedString(string:"KD", attributes:attrsTotalRent2)
        attributedTotalRent1.append(attributedTotalRent2)
        lblDiscountRent.attributedText = attributedTotalRent1
        
        let dateFormater = DateFormatter()
        dateFormater.dateFormat = "dd-MM-yyyy hh:mm a"
        let checkinDate = dateFormater.date(from: "\(String(describing: dictOfferUserDetails.check_in!)) \(String(describing: dictOfferUserDetails.admincheck_in!))")
        let difference = Calendar.current.dateComponents([.hour], from: Date(), to: checkinDate!)
        if difference.hour! <= 72 {
            self.viewNoDeposit.isHidden = true
            let totalRent = Double(dictOfferUserDetails.rent!)
            let minDeposit = Double(dictOfferUserDetails.discount_amt!)
            let remainingAmt : Int = Int(totalRent - minDeposit)
            self.lblRemainingAmt.text = "KD \(remainingAmt)"
            self.lblTotalInvoice.text = "KD \(dictOfferUserDetails.rent!)"
            let remaingTimeToPay = Int(dictOfferUserDetails.original_price!)
            
            let wedDate = Calendar.current.date( byAdding: .hour,value: -remaingTimeToPay,to: checkinDate!)
            lblRemainingDateAndTime.text = dateFormater.string(from: wedDate!)
        }else{
            self.viewNoDeposit.isHidden = false
            self.lblTotalInvoice.text = "KD \(dictOfferUserDetails.rent!)"
        }
        
        let dateFormater1 = DateFormatter()
        dateFormater1.dateFormat = "yyyy-MM-dd HH:mm:ss"
        let offerExpiry = dateFormater1.date(from: dictOfferChaletList.offer_checkin!)
        let offerCreatedDate = dateFormater1.date(from: dictOfferChaletList.offer_created_at!)
        let expiry = Calendar.current.date( byAdding: .hour,value: -Int(dictAdmin.offer_expiry!)!,to: offerExpiry!)
        let expiryStr = dateFormater1.string(from: expiry!)
       // let time = dateFormater.date(from: "05-28-2021 12:05:22")
        //let offerCreated = dateFormater.string(from: offerCreatedDate!)
        DispatchQueue.main.async {
            self.viewTopProgress.gradientColors = [UIColor.yellow.cgColor, UIColor.red.cgColor]
            self.strtTimer(time: expiryStr, offerCreated: offerCreatedDate!)
        }
        
        
    }
    
    //MARK:- ButtonActions
    //MARK:- Done button action keyboard
    @objc func doneButtonClicked() {
        self.view.endEditing(true)
    }
    @objc func backButtonTouched()  {
        self.navigationController?.popViewController(animated: true)
    }
    @IBAction func btnPrevAction(_ sender: Any) {
        if selectedIndex != 0 {
            selectedIndex = selectedIndex - 1
            self.setValuesToFields(selectIndex: selectedIndex)
            self.tableView.reloadData()
            self.collectionViewAgreement.reloadData()
            self.collectionViewNew.reloadData()
            self.collectionViewChalletDetails.reloadData()
        }
    }
    @IBAction func btnForwardAction(_ sender: UIButton) {
        if selectedIndex != arrayUserDetails.count - 1 {
            selectedIndex = selectedIndex + 1
            self.setValuesToFields(selectIndex: selectedIndex)
            self.tableView.reloadData()
            self.collectionViewAgreement.reloadData()
            self.collectionViewNew.reloadData()
            self.collectionViewChalletDetails.reloadData()
        }
    }
    @IBAction func btnPrevActionCollectioView(_ sender: Any) {
        
        if collectionIndex != 0 {
            collectionIndex = collectionIndex - 1
            collectionViewNew.scrollToItem(at: IndexPath(item: collectionIndex, section: 0), at: .centeredHorizontally, animated: true)
            
        }
        
    }
    @IBAction func btnForwardvActionCollectioView(_ sender: Any) {
        
        if collectionIndex != (arrayUserDetails[selectedIndex].chalet_upload!.count - 1) {
            collectionIndex = collectionIndex + 1
            collectionViewNew.scrollToItem(at: IndexPath(item: collectionIndex, section: 0), at: .centeredHorizontally, animated: true)
            
        }
        
    }
    
    @IBAction func btnBookingDetailDepositAction(_ sender: UIButton) {
        
        if sender.isSelected == false{
            sender.isSelected = true
            self.isClickDeposit = true
                self.heightConstrain.constant = 40
                self.viewDeposit.isHidden = false
                self.tableView.reloadRows(at: [IndexPath(row: 3, section: 0)], with: .bottom)
            
            
        }else{
            sender.isSelected = false
            self.isClickDeposit = false
                self.heightConstrain.constant = 0
                self.viewDeposit.isHidden = true
                self.tableView.reloadRows(at: [IndexPath(row: 3, section: 0)], with: .top)
            
        }
        
        
        
    }
    @IBAction func btnWhatsapAction(_ sender: UIButton) {
        //var documentInteractionController = UIDocumentInteractionController()
        let shareImage = self.tableView.screenshot()
        //let urlWhats = "whatsapp://app"
        /*if let urlString = urlWhats.addingPercentEncoding(withAllowedCharacters:CharacterSet.urlQueryAllowed) {
         if let whatsappURL = URL(string: urlString) {
         if UIApplication.shared.canOpenURL(whatsappURL as URL) {
         if let image = shareImage {
         if let imageData = image.jpegData(compressionQuality: 1.0) {
         let tempFile = URL(fileURLWithPath: NSHomeDirectory()).appendingPathComponent("Documents/whatsAppTmp.wai")
         do {
         try imageData.write(to: tempFile, options: .atomic)
         documentInteractionController = UIDocumentInteractionController(url: tempFile)
         documentInteractionController.uti = "net.whatsapp.image"
         documentInteractionController.presentOpenInMenu(from: CGRect.zero, in: self.view, animated: true)
         } catch {
         print(error)
         }
         }
         }
         } else {
         print("Cannot open whatsapp")
         }
         }
         }*/
        if shareImage != nil {
            
            let activityController = UIActivityViewController(activityItems: [shareImage!], applicationActivities: nil)
            //UIActivityViewController(activityItems: (shareImage), applicationActivities: nil)
            
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
    @IBAction func btnClickAgreement(_ sender: UIButton) {
        
        if self.arrayAgreeMentIdxs.contains(sender.tag){
            if let idx =  self.arrayAgreeMentIdxs.firstIndex(where: {$0 == sender.tag}) {
                self.arrayAgreeMentIdxs.remove(at: idx)
            }
        }else{
            self.arrayAgreeMentIdxs.append(sender.tag)
        }
        if self.isSelectTermsAgreement == true && self.arrayAgreeMentIdxs.count == self.arrayAgreements.count{
            self.btnPayment.backgroundColor = #colorLiteral(red: 0.002171910696, green: 0.6666592845, blue: 0.007707458573, alpha: 1)
            self.isPaymentEnable = true
        }else{
            self.btnPayment.backgroundColor = .lightGray
            self.isPaymentEnable = false
        }
        self.collectionViewAgreement.reloadData()
        
        
    }
    @IBAction func btnClickFinalAgreementAction(_ sender: UIButton) {
        if sender.isSelected == false{
            sender.isSelected = true
            self.isSelectTermsAgreement = true
        }else{
            sender.isSelected = false
            self.isSelectTermsAgreement = false
        }
        
        if self.isSelectTermsAgreement == true && self.arrayAgreeMentIdxs.count == self.arrayAgreements.count{
            self.btnPayment.backgroundColor = #colorLiteral(red: 0.002171910696, green: 0.6666592845, blue: 0.007707458573, alpha: 1)
            self.isPaymentEnable = true
        }else{
            self.btnPayment.backgroundColor = .lightGray
            self.isPaymentEnable = false
        }
    }
    
    @IBAction func btnPaymentAction(_ sender: UIButton) {
        
        if self.isPaymentEnable == true {
            if CAUser.currentUser.id != nil {
                self.intialisePaymentWithType()
            }else{
              
                let alert = UIAlertController(title: "Message", message: "Please Login for booking. Do you want to continue?", preferredStyle: .alert)
                alert.addAction(UIAlertAction(title: "Yes", style: .default, handler: { action in
                    let loginSignUpViewController = UIStoryboard(name: "Profile", bundle: Bundle.main).instantiateViewController(identifier: "LoginSignUpViewController") as! LoginSignUpViewController
                    loginSignUpViewController.isFromNoLogin = true
                    self.navigationController?.pushViewController(loginSignUpViewController, animated: true)
                }))
                alert.addAction(UIAlertAction(title: "No", style: .cancel, handler: { action in
                    
                }))
                self.present(alert, animated: true, completion: nil)
                
            }
        }
        /*let bookingDetailsTVC = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(identifier: "BookingDetailsTVC") as! BookingDetailsTVC
        bookingDetailsTVC.arrayUserDetails = self.arrayUserDetails
        bookingDetailsTVC.selectedIndex = self.selectedIndex
        navigationController?.pushViewController(bookingDetailsTVC, animated: true)*/
        
       /* let bookingDetailsTVC = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(identifier: "BookingDetailsTVC") as! BookingDetailsTVC
        self.navigationController?.pushViewController(bookingDetailsTVC, animated: true)*/
    }
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        
        
        
        if indexPath.row == 4 {
            if self.isClickDeposit == false {
                return 216
            }else{
                return 530
            }
        }else if indexPath.row == 0{
            if isFromOffer == true{
                return 0
            }else{
                return 55
            }
            
        }else if indexPath.row == 1 {
            if isFromOffer == true{
                return 165
            }else{
                return 0
            }
            
        }else if indexPath.row == 2 {
            
            
            return 371
            
        }else if indexPath.row == 5 {
            
            if isFromOffer == false{
                let arrayHeight = arrayUserDetails[selectedIndex].chalet_details!.count * 23
                return CGFloat(57 + arrayHeight)
            }else{
                let arrayHeight = dictOfferUserDetails.chalet_details!.count * 23
                return CGFloat(57 + arrayHeight)
            }
            
        }else if indexPath.row == 6 {
            let arrayHeight = arrayAgreements.count * 35
            return CGFloat(138 + arrayHeight)
            
        }else{
            
            return super.tableView(tableView, heightForRowAt: indexPath)
        }
    }
    
}
extension ReservationTVC : UICollectionViewDelegate, UICollectionViewDataSource {
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        if collectionView.tag == 1 {
            if isFromOffer == true{
                return dictOfferUserDetails.chalet_upload?.count ?? 0
            }else{
                return arrayUserDetails[selectedIndex].chalet_upload?.count ?? 0
            }
        }else if collectionView.tag ==  2 {
            if isFromOffer == true{
                return dictOfferUserDetails.chalet_details?.count ?? 0
            }else{
                return arrayUserDetails[selectedIndex].chalet_details?.count ?? 0
            }
            
        }else if collectionView.tag ==  10 {
            if isFromOffer == true{
                return dictOfferUserDetails.chalet_upload?.count ?? 0
            }else{
                return arrayUserDetails[selectedIndex].chalet_upload?.count ?? 0
            }
            
            
        }else{
            return arrayAgreements.count
        }
    }
    
    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        if collectionView.tag == 10 {
            
            var arr = [Chalet_upload]()
            if isFromOffer == true{
                arr = dictOfferUserDetails.chalet_upload!
            }else{
                arr = arrayUserDetails[selectedIndex].chalet_upload!
            }
            if arr.count > 0 {
            if arr[indexPath.item].file_name!.contains(".jpg"){
                let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "CollectionViewIMageVideoCVCell", for: indexPath) as! CollectionViewIMageVideoCVCell
                
                DispatchQueue.main.async {
                    cell.imgChaletImage.sd_setImage(with: URL(string: arr[indexPath.item].file_name!), placeholderImage: kPlaceHolderImage, options: .highPriority) { image, error, cache, url in
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
                /*cell.imgChaletImage.sd_setImage(with: URL(string: arr[indexPath.item].file_name!), placeholderImage: kPlaceHolderImage, options: .highPriority) { image, error, cache, url in
                 if image != nil {
                 cell.imgChaletImage.image = image
                 }else{
                 cell.imgChaletImage.image = kPlaceHolderImage
                 }
                 }*/
                if isFromOffer == false{
                    cell.playVideo(videourl: arr[indexPath.item].file_name!, previewImage: "")
                }else{
                    cell.playVideo(videourl: dictOfferUserDetails.chalet_upload![indexPath.item].file_name!, previewImage: "")
                }
                return cell
            }
            }else{
                let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "CollectionViewVideoCVCell", for: indexPath) as! CollectionViewVideoCVCell
                cell.imgChaletImage.image = kPlaceHolderImage
                return cell
            }
            
        }else if collectionView.tag ==  1 {
            let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "CollectionViewIMageVideoCVCell", for: indexPath) as! CollectionViewIMageVideoCVCell
            //cell.imgChaletImage.image = imgArr[indexPath.row]
            return cell
            
        }else if collectionView.tag ==  2 {
            let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "CollectionViewChaletDetailsCVCell", for: indexPath) as! CollectionViewChaletDetailsCVCell
            cell.btnIcon.addCornerForView(cornerRadius: 2.5)
            if isFromOffer == false{
            cell.setValuesToFields(dict: arrayUserDetails[selectedIndex].chalet_details![indexPath.item])
            
            }else{
                cell.setValuesToFields(dict: dictOfferUserDetails.chalet_details![indexPath.item])
            }
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
            //cell.lblAgreement.text = self.arrayAgreements[indexPath.item].agreement_content!
            cell.btnAgreement.addCornerForView(cornerRadius: 8.0)
            cell.btnAgreement.tag = indexPath.item
            if arrayAgreeMentIdxs.contains(indexPath.item){
                cell.btnAgreement.isSelected = true
            }else{
                cell.btnAgreement.isSelected = false
            }
            return cell
            
        }
    }
    
    func collectionView(_ collectionView: UICollectionView, didSelectItemAt indexPath: IndexPath) {
        if collectionView.tag == 3 {
            
            if self.arrayAgreements.count > 0 {
               // if verifyUrl(urlString: self.arrayAgreements[indexPath.item].agreement_content!){
                    let termsAndConditionsVC = UIStoryboard(name: "ProfileNew", bundle: Bundle.main).instantiateViewController(identifier: "TermsAndConditionVC") as! TermsAndConditionVC
                termsAndConditionsVC.isFromReservation = true
                    termsAndConditionsVC.UrlString = self.arrayAgreements[indexPath.item].agreement_content!
                    let vc = UINavigationController(rootViewController: termsAndConditionsVC)
                    self.present(vc, animated: true, completion: nil)
                /*}else{
                    print("Not a valid url")
                }*/
            }
        }
    }
    
    /*func collectionView(_ collectionView: UICollectionView, layout collectionViewLayout: UICollectionViewLayout, sizeForItemAt indexPath: IndexPath) -> CGSize {
        
        let width = kScreenWidth - 30
            return CGSize(width: width , height: 315)
        
        
    }
    func collectionView(_ collectionView: UICollectionView, layout collectionViewLayout: UICollectionViewLayout, minimumLineSpacingForSectionAt section: Int) -> CGFloat {
        
            return 0
        
        
    }*/
    func verifyUrl (urlString: String?) -> Bool {
        if let urlString = urlString {
            if let url = NSURL(string: urlString) {
                return UIApplication.shared.canOpenURL(url as URL)
            }
        }
        return false
    }
    
}

extension ReservationTVC {
    //MARK:- Reservation
    func chaletBooking(chaletId:String,selectedPackage:String,checkIn:String,checkOut:String,deposit:String,rent:String,totalPaid:String,paymentGateway:String,paymentId:String,authId:String,trackId:String,transcationId:String,invoiceReference:String,referenceId:String) {
        
        if CAUser.currentUser.id != nil {
            ServiceManager.sharedInstance.postMethodAlamofire("api/booking", dictionary: ["userid":CAUser.currentUser.id!,"chaletid":chaletId,"selected_package":selectedPackage,"check_in":checkIn,"check_out":checkOut,"deposit":deposit,"rent":rent,"total_paid":totalPaid,"reward_discount":0,"offer_discount":0,"payment_gateway":paymentGateway,"payment_id":paymentId,"authorization_id":authId,"track_id":trackId,"transaction_id":transcationId,"invoice_reference":invoiceReference,"reference_id":referenceId], withHud: true) { (success, response, error) in
                if success {
                    if ((response as! NSDictionary)["status"] as! Bool) == true {
                        let responseBase = BookingDetailBase(dictionary: response as! NSDictionary)
                        self.dictBookingDetails = responseBase?.booking_details
                        DispatchQueue.main.async {
                            let bookingDetailsTVC = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(identifier: "BookingDetailsTVC") as! BookingDetailsTVC
                            bookingDetailsTVC.dictBookingDetails = self.dictBookingDetails
                            self.navigationController?.pushViewController(bookingDetailsTVC, animated: true)
                        }
                    }else{
                        showDefaultAlert(viewController: self, title: "Message", msg: "Something went wrong")
                    }
                }else{
                    showDefaultAlert(viewController: self, title: "Message", msg: error!.localizedDescription)
                }
            }
        }else{
            showDefaultAlert(viewController: self, title: "Message", msg: "Please Login for booking")
        }
        
    }
}
extension ReservationTVC {
    
    //MARK:- Payment Integration
    func initiatePayment() {
        let request = generateInitiatePaymentModel()
        SVProgressHUD.show()
        MFPaymentRequest.shared.initiatePayment(request: request, apiLanguage: .english, completion: { [weak self] (result) in
            SVProgressHUD.dismiss()
            switch result {
            case .success(let initiatePaymentResponse):
                self?.paymentMethods = initiatePaymentResponse.paymentMethods
            case .failure(let failError):
                showDefaultAlert(viewController: self!, title: "Failed..!", msg: "result: \(failError)")
            }
        })
    }
    
    func intialisePaymentWithType() {
        if let paymentMethods = paymentMethods, !paymentMethods.isEmpty {
            let selectedIndex = selectedPaymentMethodIndex
            executePayment(paymentMethodId: paymentMethods[selectedIndex].paymentMethodId)
        }
    }
    
    func executePayment(paymentMethodId: Int) {
        let request = getExecutePaymentRequest(paymentMethodId: paymentMethodId)
        SVProgressHUD.show()
        MFPaymentRequest.shared.executePayment(request: request, apiLanguage: .english) { [weak self] response, invoiceId  in
            SVProgressHUD.dismiss()
            switch response {
            case .success(let executePaymentResponse):
                if let invoiceStatus = executePaymentResponse.invoiceStatus {
                   // showDefaultAlert(viewController: self!, title: "Success..!", msg: "result: \(invoiceStatus)")
                    
                    //executePaymentResponse.invoiceReference
                    let dataDict = executePaymentResponse.invoiceTransactions?.first!
                    
                    let dict = self?.arrayUserDetails[(self?.selectedIndex)!]
                    DispatchQueue.main.async {
                        self!.chaletBooking(chaletId: "\((dict?.chalet_id!)!)", selectedPackage: self!.selectedPackage, checkIn: (dict?.check_in!)!, checkOut: (dict?.check_out!)!, deposit: self!.isClickDeposit == false ? "0" : (dict?.min_deposit!)!, rent: (dict?.rent!)!, totalPaid: self!.isClickDeposit == false ? (dict?.rent!)! : (dict?.min_deposit!)!,paymentGateway: (dataDict?.paymentGateway!)!,paymentId: (dataDict?.paymentID!)!,authId: (dataDict?.authorizationID!)!,trackId: (dataDict?.trackID!)!,transcationId: (dataDict?.transactionID)!,invoiceReference: executePaymentResponse.invoiceReference!,referenceId: (dataDict?.referenceID)!)
                    }
                    
                }
            case .failure(let failError):
                showDefaultAlert(viewController: self!, title: "Failed..!", msg: "result: \(failError)")
            }
        }
    }
    
    
    
     func getExecutePaymentRequest(paymentMethodId: Int) -> MFExecutePaymentRequest {
        
        var rent = ""
        if isClickDeposit == true{
            rent = self.arrayUserDetails[self.selectedIndex].min_deposit!
        }else{
            rent = self.arrayUserDetails[self.selectedIndex].rent!
        }
        
        let invoiceValue = Decimal(string: rent ) ?? 0
        let request = MFExecutePaymentRequest(invoiceValue: invoiceValue , paymentMethod: paymentMethodId)
        //request.userDefinedField = ""
        request.customerEmail = self.arrayUserDetails[self.selectedIndex].email!// must be email
        request.customerMobile = self.arrayUserDetails[self.selectedIndex].phone!
        request.customerCivilId = self.arrayUserDetails[self.selectedIndex].civil_id!
        request.customerName = self.arrayUserDetails[self.selectedIndex].firstname!
        let address = MFCustomerAddress(block: "ddd", street: "sss", houseBuildingNo: "sss", address: "sss", addressInstructions: "sss")
        request.customerAddress = address
        request.customerReference = "Test MyFatoorah Reference"
        request.language = .english
        request.mobileCountryCode = MFMobileCountryCodeISO.kuwait.rawValue
        request.displayCurrencyIso = .kuwait_KWD
//        request.supplierValue = 1
//        request.supplierCode = 2
//        request.suppliers.append(MFSupplier(supplierCode: 1, proposedShare: 2, invoiceShare: invoiceValue))
        
        // Uncomment this to add products for your invoice
//         var productList = [MFProduct]()
//        let product = MFProduct(name: "ABC", unitPrice: 1.887, quantity: 1)
//         productList.append(product)
//         request.invoiceItems = productList
        return request
    }
    
    private func generateInitiatePaymentModel() -> MFInitiatePaymentRequest {
        // you can create initiate payment request with invoice value and currency
        // let invoiceValue = Double(amountTextField.text ?? "") ?? 0
        // let request = MFInitiatePaymentRequest(invoiceAmount: invoiceValue, currencyIso: .kuwait_KWD)
        // return request
        
        let request = MFInitiatePaymentRequest()
        return request
    }

    
    
    
}
extension ReservationTVC {
    
    func strtTimer(time:String,offerCreated:Date)  {
        let timeee = time
        let dateFormater = DateFormatter()
        dateFormater.dateFormat = "yyyy-MM-dd HH:mm:ss"
        let timeFormatter = DateFormatter()
        timeFormatter.dateFormat = "hh:mm a"
        let date = dateFormater.date(from: time)!
        //let time = timeFormatter.string(from: date!)
        let dd = DateCountDownTimer()
        dd.initializeTimer(timeee)
        let seconds : Double = Double(Date().seconds(from: offerCreated))
        let totalSeconds : Double = Double(date.seconds(from: offerCreated))
        let remainingSeconds : Double = Double(date.seconds(from: Date()))
        var progressValue = (seconds / totalSeconds)
        //progressView.progress = Float(progressValue)
        viewTopProgress.setProgress(Float(progressValue), animated: true)
        dd.startTimer(pUpdateActionHandler: { [self] (time) in
            progressValue = progressValue + 0.00001
            self.lblTimeProgress.text = time
            viewTopProgress.progress = Float(progressValue)
        }) {
            DispatchQueue.main.async {
                print("Completed")
            }
        }
    }
    
}
extension ReservationTVC {
    
    
    func getAgreementsDetails() {
        ServiceManager.sharedInstance.postMethodAlamofire("api/agreements", dictionary: nil, withHud: true) { [self] (success, response, error) in
            if success {
                if ((response as! NSDictionary)["status"] as! Bool) == true {
                    
                    let jsonBase = AgreementListBase(dictionary: response as! NSDictionary)
                    self.arrayAgreements = (jsonBase?.agreement)!
                    DispatchQueue.main.async {
                        
                        self.collectionViewAgreement.reloadData()
                        self.tableView.reloadRows(at: [IndexPath(row: 6, section: 0)], with: .none)
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

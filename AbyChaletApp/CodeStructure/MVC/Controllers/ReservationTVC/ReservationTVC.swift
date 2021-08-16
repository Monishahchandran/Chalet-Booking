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
    
    
    
    @IBOutlet weak var viewDepositBg: UIView!
    @IBOutlet weak var lblDeposit72No: UILabel!
    @IBOutlet var viewPlayer: UIView!
    @IBOutlet weak var lblCollectionIndex: UILabel!
    @IBOutlet weak var lblTotalRewardTitle: UILabel!
    @IBOutlet weak var lblAgreementStr: UILabel!
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
    @IBOutlet weak var lbllRemaining: UILabel!
    @IBOutlet weak var lbllTotalInvoice: UILabel!
    @IBOutlet weak var collectionViewChalletDetails: UICollectionView!
    @IBOutlet weak var viewAgreement: UIView!
    @IBOutlet weak var viewAgreementHeading: UIView!
    @IBOutlet weak var viewAgreementBottom: UIView!
    @IBOutlet weak var collectionViewAgreement: UICollectionView!
    @IBOutlet weak var viewDeposit: UIView!
    @IBOutlet weak var heightConstrain: NSLayoutConstraint!
    
    @IBOutlet weak var viewCollectionIndex: UIView!
    @IBOutlet weak var lblCheckOutDate: UILabel!
    @IBOutlet weak var lblCheckInDate: UILabel!
    @IBOutlet weak var lblCheckOutTime: UILabel!
    @IBOutlet weak var lblCheckInTime: UILabel!
    @IBOutlet weak var lblRent: UILabel!
    
    @IBOutlet weak var viewPrev: UIView!
    @IBOutlet weak var viewForward: UIView!
    var blurView                : UIView!
    @IBOutlet var popUpSelectImage: UIView!
    @IBOutlet weak var lblBookingDetails: UILabel!
    
    @IBOutlet weak var lblRentalPriceTitel: UILabel!
    
    var isUSerIsBlocked = false
    
    let text = "I have read and Agree to the terms of service "
    var lblIndexValue = 1
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
    var arrayAdminDetails = [Admin_details]()
    var isUnpaidDone = true
    override func viewDidLoad() {
        super.viewDidLoad()

        
        self.setUpNavigationBar()
        self.setupUI()
        self.getAdminDetails()
        if isFromOffer == true{
            self.setValuesFromOffer(selectIndex: 0)
        }else{
            self.setValuesToFields(selectIndex: selectedIndex)
        }
        //check
        lblBookingDetails.text = "Booking Details".localized()
        lblRentalPriceTitel.text = "Rental price".localized()
        lblTotalRewardTitle.text = "Total Rewards (Discount)".localized()
        
        if kCurrentLanguageCode == "ar"{
            lblBookingDetails.font = UIFont(name: kFontAlmaraiRegular, size: 17)
            lblRentalPriceTitel.font = UIFont(name: kFontAlmaraiRegular, size: 15)
            lblTotalRewardTitle.font = UIFont(name: kFontAlmaraiRegular, size: 15)
        }else {
            lblBookingDetails.font = UIFont(name: "Roboto-Medium", size: 17)
            lblRentalPriceTitel.font = UIFont(name: "Roboto-Regular", size: 15)
            lblTotalRewardTitle.font = UIFont(name: "Roboto-Regular", size: 15)
        }
        
        
        
        initiatePayment()
        NotificationCenter.default.addObserver(self, selector: #selector(logoutUser), name: NSNotification.Name(rawValue: NotificationNames.kBlockedUser), object: nil)
    }
    
    override func viewWillAppear(_ animated: Bool) {
        appDelegate.checkBlockStatus()
    }
    
    @objc func logoutUser() {
        
        appDelegate.logOut()
        
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
        self.viewCollectionIndex.roundCorners(corners: [.bottomRight], radius: 10.0)
    }
    
    override func viewDidDisappear(_ animated: Bool) {
        NotificationCenter.default.post(name: NSNotification.Name(rawValue: NotificationNames.kStopVideoPlayer), object: nil, userInfo: nil)

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
        self.navigationItem.title = "Reservation".localized()
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
        
        let attrsWhatKindOfJob1 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Regular", size: 14)!, NSAttributedString.Key.foregroundColor : #colorLiteral(red: 1, green: 1, blue: 1, alpha: 1)] as [NSAttributedString.Key : Any]
        let attrsWhatKindOfJob2 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Medium", size: 15)!, NSAttributedString.Key.foregroundColor : #colorLiteral(red: 1, green: 1, blue: 1, alpha: 1)] as [NSAttributedString.Key : Any]
        let attrsWhatKindOfJob3 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Medium", size: 15)!, NSAttributedString.Key.foregroundColor : #colorLiteral(red: 0.9686274529, green: 0.78039217, blue: 0.3450980484, alpha: 1),NSAttributedString.Key.underlineStyle : NSUnderlineStyle.thick.rawValue] as [NSAttributedString.Key : Any]
        
        let attributedStringWhatKindOfJob1 = NSMutableAttributedString(string:"I have read and ", attributes:attrsWhatKindOfJob1)
        let attributedStringWhatKindOfJob2 = NSMutableAttributedString(string:"Agree ", attributes:attrsWhatKindOfJob2)
        let attributedStringWhatKindOfJob3 = NSMutableAttributedString(string:"to the ", attributes:attrsWhatKindOfJob1)
        let attributedStringWhatKindOfJob4 = NSMutableAttributedString(string:"terms", attributes:attrsWhatKindOfJob3)
        let attributedStringWhatKindOfJob5 = NSMutableAttributedString(string:" of service ", attributes:attrsWhatKindOfJob1)
        attributedStringWhatKindOfJob1.append(attributedStringWhatKindOfJob2)
        attributedStringWhatKindOfJob1.append(attributedStringWhatKindOfJob3)
        attributedStringWhatKindOfJob1.append(attributedStringWhatKindOfJob4)
        attributedStringWhatKindOfJob1.append(attributedStringWhatKindOfJob5)
        self.lblAgreement.attributedText = attributedStringWhatKindOfJob1
        
        self.lblAgreement.isUserInteractionEnabled = true
        self.lblAgreement.addGestureRecognizer(UITapGestureRecognizer(target:self, action: #selector(tapLabel(gesture:))))
        self.lblDeposit72No.font = UIFont(name: "Roboto-BoldItalic", size: 15)
        self.lblDeposit72No.text = "No Deposit 72 hours before Check-in".localized()
    }
    
    @objc func tapLabel(gesture: UITapGestureRecognizer) {
        let termsRange = (text as NSString).range(of: "terms")
        // comment for now
        //let privacyRange = (text as NSString).range(of: "Privacy Policy")
        
        if gesture.didTapAttributedTextInLabel(label: lblAgreement, inRange: termsRange) {
            if self.arrayAdminDetails.count > 0 {
                let termsAndConditionsVC = UIStoryboard(name: "ProfileNew", bundle: Bundle.main).instantiateViewController(identifier: "TermsAndConditionVC") as! TermsAndConditionVC
                termsAndConditionsVC.isFromReservation = false
                termsAndConditionsVC.UrlString = self.arrayAdminDetails.first!.legal_privacy!
                let vc = UINavigationController(rootViewController: termsAndConditionsVC)
                self.present(vc, animated: true, completion: nil)
            }
        } else {
            print("Tapped none")
        }
    }
    
    //MARK:- setValuesToFields
    func setValuesToFields(selectIndex:Int) {
        
        let attrsKd = [NSAttributedString.Key.font : UIFont(name: "Roboto-Regular", size: 15)!, NSAttributedString.Key.foregroundColor : #colorLiteral(red: 0.1960784314, green: 0.3843137255, blue: 0.4666666667, alpha: 1)] as [NSAttributedString.Key : Any]
        let attrsAmt = [NSAttributedString.Key.font : UIFont(name: "Roboto-Bold", size: 16)!, NSAttributedString.Key.foregroundColor : #colorLiteral(red: 0.1960784314, green: 0.3843137255, blue: 0.4666666667, alpha: 1)] as [NSAttributedString.Key : Any]
        
        let kd = NSMutableAttributedString(string:"KD ", attributes:attrsKd)
        let rent = NSMutableAttributedString(string:"\(arrayUserDetails[selectIndex].rent!)", attributes:attrsAmt)
        kd.append(rent)
        self.lblRent.attributedText = kd

       // self.lblRent.text = "KD \(arrayUserDetails[selectIndex].rent!)"
        self.lblCheckOutDate.text = arrayUserDetails[selectIndex].check_out?.appFormattedDate
        self.lblCheckInDate.text = arrayUserDetails[selectIndex].check_in?.appFormattedDate
        self.lblCheckInTime.text = arrayUserDetails[selectIndex].admincheck_in
        self.lblCheckOutTime.text = arrayUserDetails[selectIndex].admincheck_out
        self.lblSlNo.text = "No.\(arrayUserDetails[selectedIndex].chalet_id ?? 0)"
        self.lblChaletName.text = arrayUserDetails[selectedIndex].chalet_name
        
        let depoKd = NSMutableAttributedString(string:"KD ", attributes:attrsKd)
        let deposit = NSMutableAttributedString(string:"\(arrayUserDetails[selectedIndex].min_deposit!)", attributes:attrsAmt)
        depoKd.append(deposit)
        self.lblDeposit.attributedText = depoKd
            //"KD \(arrayUserDetails[selectedIndex].min_deposit!)"
        let dateFormater = DateFormatter()
        dateFormater.dateFormat = "yyyy-MM-dd hh:mm a"
        let checkinDate = dateFormater.date(from: "\(String(describing: arrayUserDetails[selectIndex].check_in!)) \(String(describing: arrayUserDetails[selectIndex].admincheck_in!))")
        let difference = Calendar.current.dateComponents([.hour], from: Date(), to: checkinDate!)
        if difference.hour! >= 72 {
            self.viewNoDeposit.isHidden = true
            let totalRent = Double(arrayUserDetails[selectIndex].rent!)
            let minDeposit = Double(arrayUserDetails[selectedIndex].min_deposit!)
            let remainingAmt : Int = Int(totalRent! - minDeposit!)
            self.lblRemainingAmt.text = "KD \(remainingAmt)"
            self.lblTotalInvoice.text = "KD \(arrayUserDetails[selectIndex].rent!)"
            let remaingTimeToPay = Int(arrayUserDetails[selectIndex].remaining_amt_pay!)
            
            let wedDate = Calendar.current.date( byAdding: .hour,value: -remaingTimeToPay!,to: checkinDate!)
            dateFormater.dateFormat = "dd/MM/yyyy ( hh:mm a )"
            lblRemainingDateAndTime.text = dateFormater.string(from: wedDate!)
        }else{
            self.viewNoDeposit.isHidden = false
            self.lblTotalInvoice.text = "KD \(arrayUserDetails[selectIndex].rent!)"
            self.lblTotalInvoice.font = UIFont(name: "Roboto-Bold", size: 16.0)
        }
        
        self.lblCollectionIndex.text = "\(lblIndexValue)/\(String(describing: arrayUserDetails[selectedIndex].chalet_upload!.count))"
    }
    //MARK:- setValuesToFields
    func setValuesFromOffer(selectIndex:Int) {
        
        let attrsKd = [NSAttributedString.Key.font : UIFont(name: "Roboto-Regular", size: 15)!, NSAttributedString.Key.foregroundColor : #colorLiteral(red: 0.1960784314, green: 0.3843137255, blue: 0.4666666667, alpha: 1)] as [NSAttributedString.Key : Any]
        let attrsAmt = [NSAttributedString.Key.font : UIFont(name: "Roboto-Bold", size: 16)!, NSAttributedString.Key.foregroundColor : #colorLiteral(red: 0.1960784314, green: 0.3843137255, blue: 0.4666666667, alpha: 1)] as [NSAttributedString.Key : Any]
        
        let totalaMt : Int = dictOfferUserDetails.original_price! - dictOfferUserDetails.discount_amt!
        let kd = NSMutableAttributedString(string:"KD ", attributes:attrsKd)
        let rent = NSMutableAttributedString(string:"\(dictOfferUserDetails.rent!)", attributes:attrsAmt)
        kd.append(rent)
        self.lblRent.attributedText = kd
        
        
       // self.lblRent.text = "KD \(dictOfferUserDetails.rent!)"
        self.lblCheckOutDate.text = dictOfferUserDetails.check_out?.appFormattedDateOffereDetail
        self.lblCheckInDate.text = dictOfferUserDetails.check_in?.appFormattedDateOffereDetail
        self.lblCheckInTime.text = dictOfferUserDetails.admincheck_in
        self.lblCheckOutTime.text = dictOfferUserDetails.admincheck_out
        self.lblSlNo.text = "No. \(dictOfferUserDetails.chalet_id ?? 0)"
        self.lblChaletName.text = dictOfferUserDetails.chalet_name
        
        let depoKd = NSMutableAttributedString(string:"KD ", attributes:attrsKd)
        let deposit = NSMutableAttributedString(string:"\(dictOfferUserDetails.min_deposit!)", attributes:attrsAmt)
        depoKd.append(deposit)
        self.lblDeposit.attributedText = depoKd
        
        //self.lblDeposit.text = "KD \(dictOfferUserDetails.discount_amt!)"
        
        let attributeString: NSMutableAttributedString =  NSMutableAttributedString(string: "\(dictOfferUserDetails.original_price!) KD")
            attributeString.addAttribute(NSAttributedString.Key.strikethroughStyle, value: 2, range: NSMakeRange(0, attributeString.length))
        self.lblTotalRent.attributedText = attributeString
        
        
        let attrsTotalRent1 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Bold", size: 30)!, NSAttributedString.Key.foregroundColor : #colorLiteral(red: 0.2156862745, green: 0.6235294118, blue: 0, alpha: 1)] as [NSAttributedString.Key : Any]
        let attrsTotalRent2 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Medium", size: 25)!, NSAttributedString.Key.foregroundColor : #colorLiteral(red: 0.1176470588, green: 0.262745098, blue: 0.3333333333, alpha: 1)] as [NSAttributedString.Key : Any]
        
        
        let attributedTotalRent1 = NSMutableAttributedString(string:"\(totalaMt) ", attributes:attrsTotalRent1)
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
            self.lblTotalInvoice.font = UIFont(name: "Roboto-Bold", size: 16.0)
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
        self.lblCollectionIndex.text = "\(lblIndexValue)/\(String(describing: dictOfferUserDetails.chalet_upload!.count))"
        
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
            NotificationCenter.default.post(name: NSNotification.Name(rawValue: NotificationNames.kStopVideoPlayer), object: nil, userInfo: nil)
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
            NotificationCenter.default.post(name: NSNotification.Name(rawValue: NotificationNames.kStopVideoPlayer), object: nil, userInfo: nil)
        }
    }
    @IBAction func btnPrevActionCollectioView(_ sender: Any) {
        if collectionIndex != 0 {
            collectionIndex = collectionIndex - 1
            lblIndexValue = lblIndexValue - 1
            if isFromOffer == true {
                self.lblCollectionIndex.text = "\(lblIndexValue)/\(String(describing: dictOfferUserDetails.chalet_upload!.count))"
            }else{
                self.lblCollectionIndex.text = "\(lblIndexValue)/\(String(describing: arrayUserDetails[selectedIndex].chalet_upload!.count))"
            }
            collectionViewNew.scrollToItem(at: IndexPath(item: collectionIndex, section: 0), at: .centeredHorizontally, animated: true)
            NotificationCenter.default.post(name: NSNotification.Name(rawValue: NotificationNames.kStopVideoPlayer), object: nil, userInfo: nil)
        }
        
    }
    @IBAction func btnForwardvActionCollectioView(_ sender: Any) {
        
        DispatchQueue.main.async { [self] in
            if self.isFromOffer == true{
                if self.dictOfferUserDetails.chalet_upload!.count > 0 {
                    if self.collectionIndex != (self.dictOfferUserDetails.chalet_upload!.count - 1) {
                        self.collectionIndex = collectionIndex + 1
                        self.lblIndexValue = lblIndexValue + 1
                        self.lblCollectionIndex.text = "\(lblIndexValue)/\(String(describing: self.dictOfferUserDetails.chalet_upload!.count))"
                        collectionViewNew.scrollToItem(at: IndexPath(item: self.collectionIndex, section: 0), at: .centeredHorizontally, animated: true)
                    }
                }
            }else{
                if self.arrayUserDetails[selectedIndex].chalet_upload!.count > 0{
                    if collectionIndex != (self.arrayUserDetails[selectedIndex].chalet_upload!.count - 1) {
                        self.collectionIndex = collectionIndex + 1
                        self.lblIndexValue = lblIndexValue + 1
                        self.lblCollectionIndex.text = "\(lblIndexValue)/\(String(describing: self.arrayUserDetails[selectedIndex].chalet_upload!.count))"
                        collectionViewNew.scrollToItem(at: IndexPath(item: self.collectionIndex, section: 0), at: .centeredHorizontally, animated: true)
                    }
                }
            }
        }
        NotificationCenter.default.post(name: NSNotification.Name(rawValue: NotificationNames.kStopVideoPlayer), object: nil, userInfo: nil)
    }
    
    @IBAction func btnBookingDetailDepositAction(_ sender: UIButton) {
        
        var rent = 0
        var deposit = 0
        if isFromOffer == false{
            
            rent = Int(arrayUserDetails[selectedIndex].rent!)!
            deposit = Int(arrayUserDetails[selectedIndex].min_deposit!)!
        }else{
            rent  = dictOfferUserDetails.discount_amt!
            deposit = Int(dictOfferUserDetails.min_deposit!)!
        }
        
        
        if rent >= deposit {
            if sender.isSelected == false{
                sender.isSelected = true
                self.isClickDeposit = true
                self.heightConstrain.constant = 40
                self.viewDeposit.isHidden = false
                self.lblDeposit.textColor = #colorLiteral(red: 0.9686274529, green: 0.78039217, blue: 0.3450980484, alpha: 1)
                self.viewDepositBg.backgroundColor = #colorLiteral(red: 1, green: 0.06666666667, blue: 0.1647058824, alpha: 1)
                self.tableView.reloadRows(at: [IndexPath(row: 3, section: 0)], with: .bottom)
            }else{
                sender.isSelected = false
                self.isClickDeposit = false
                self.heightConstrain.constant = 0
                self.viewDeposit.isHidden = true
                self.lblDeposit.textColor = #colorLiteral(red: 0.1176470588, green: 0.262745098, blue: 0.3333333333, alpha: 1)
                self.viewDepositBg.backgroundColor = #colorLiteral(red: 0.9215686275, green: 0.9215686275, blue: 0.9215686275, alpha: 1)
                self.tableView.reloadRows(at: [IndexPath(row: 3, section: 0)], with: .top)
            }
        }else{
            showDefaultAlert(viewController: self, title: "Message", msg: "There is no deposit option for this chalet")
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
            self.btnPayment.backgroundColor = UIColor("#6FDA44")
            self.isPaymentEnable = true
        }else{
            self.btnPayment.backgroundColor = UIColor("#C2C2C2")
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
            self.btnPayment.backgroundColor = UIColor("#6FDA44")
            self.isPaymentEnable = true
        }else{
            self.btnPayment.backgroundColor = UIColor("#C2C2C2")
            self.isPaymentEnable = false
        }
    }
    
    @IBAction func btnPaymentAction(_ sender: UIButton) {
        
        if isUSerIsBlocked == false {
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
        }else{
            showDefaultAlert(viewController: self, title: "Message".localized(), msg: "Your Account has been Blocked. Please contact Administrator.")
            appDelegate.checkBlockStatus()
        }
        /*let bookingDetailsTVC = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(identifier: "BookingDetailsTVC") as! BookingDetailsTVC
        bookingDetailsTVC.arrayUserDetails = self.arrayUserDetails
        bookingDetailsTVC.selectedIndex = self.selectedIndex
        navigationController?.pushViewController(bookingDetailsTVC, animated: true)*/
        
       /* let bookingDetailsTVC = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(identifier: "BookingDetailsTVC") as! BookingDetailsTVC
        self.navigationController?.pushViewController(bookingDetailsTVC, animated: true)*/
    }
    
    @IBAction func buttonCancelForgotPasswordAction(_ sender: UIButton) {
        
        self.dismissPopUpView()
        
    }
    @IBAction func btnPlayVideoAction(_ sender: UIButton) {
        if isFromOffer == false{
            let urlStr =  arrayUserDetails[selectedIndex].chalet_upload![sender.tag].file_name!
           // self.showPlayerPopup(videourl: urlStr)
            let videoUrl = URL(string: urlStr.addingPercentEncoding(withAllowedCharacters: .urlFragmentAllowed)!)!
            let player = AVPlayer(url: videoUrl)
            let playerViewController = AVPlayerViewController()
            playerViewController.player = player
            self.present(playerViewController, animated: true) {
                playerViewController.player!.play()
            }
        }else{
            let urlStr = dictOfferUserDetails.chalet_upload![sender.tag].file_name!
            let videoUrl = URL(string: urlStr.addingPercentEncoding(withAllowedCharacters: .urlFragmentAllowed)!)!
            let player = AVPlayer(url: videoUrl)
            let playerViewController = AVPlayerViewController()
            playerViewController.player = player
            self.present(playerViewController, animated: true) {
                playerViewController.player!.play()
            }
        }
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
                return dictOfferUserDetails.chalet_upload!.count > 0 ? dictOfferUserDetails.chalet_upload!.count : 1
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
                cell.btnPlay.tag = indexPath.item
                return cell
            }
            }else{
                let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "CollectionViewIMageVideoCVCell", for: indexPath) as! CollectionViewIMageVideoCVCell
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
            cell.lblChaletDetails.textAlignment = .right
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
            cell.lblAgreement.textAlignment = .right
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
                let htmlStr = self.arrayAgreements[indexPath.item].agreement_content!
               // if verifyUrl(urlString: self.arrayAgreements[indexPath.item].agreement_content!){
                  /*  let termsAndConditionsVC = UIStoryboard(name: "ProfileNew", bundle: Bundle.main).instantiateViewController(identifier: "TermsAndConditionVC") as! TermsAndConditionVC
                termsAndConditionsVC.isFromReservation = true
                    termsAndConditionsVC.UrlString = self.arrayAgreements[indexPath.item].agreement_content!
                    let vc = UINavigationController(rootViewController: termsAndConditionsVC)
                    self.present(vc, animated: true, completion: nil)*/
                /*}else{
                    print("Not a valid url")
                }*/
                /*if let htmlData = htmlStr.data(using: String.Encoding.unicode) {
                    do {
                        lblAgreementStr.attributedText = try NSAttributedString(data: htmlData,options: [.documentType:NSAttributedString.DocumentType.html],documentAttributes: nil)
                    } catch let e as NSError {
                        print("Couldn't translate \(htmlStr): \(e.localizedDescription) ")
                        lblAgreementStr.text = self.arrayAgreements[indexPath.item].agreement_content!
                    }
                }
                lblAgreementStr.textAlignment = .right
                self.showAuthPopup()*/
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
    func chaletBooking(chaletId:String,selectedPackage:String,checkIn:String,checkOut:String,deposit:String,rent:String,totalPaid:String,paymentGateway:String,paymentId:String,authId:String,trackId:String,transcationId:String,invoiceReference:String,referenceId:String,serverUrl:String) {
        if CAUser.currentUser.id != nil {
            ServiceManager.sharedInstance.postMethodAlamofire(serverUrl, dictionary: ["userid":CAUser.currentUser.id!,"chaletid":chaletId,"selected_package":selectedPackage,"check_in":checkIn,"check_out":checkOut,"deposit":deposit,"rent":rent,"total_paid":totalPaid,"reward_discount":0,"offer_discount":0,"payment_gateway":paymentGateway,"payment_id":paymentId,"authorization_id":authId,"track_id":trackId,"transaction_id":transcationId,"invoice_reference":invoiceReference,"reference_id":referenceId], withHud: true) { (success, response, error) in
                if success {
                    if ((response as! NSDictionary)["status"] as! Bool) == true {
                        let responseBase = BookingDetailBase(dictionary: response as! NSDictionary)
                        self.dictBookingDetails = responseBase?.booking_details
                        DispatchQueue.main.async {
                            let bookingDetailsTVC = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(identifier: "BookingDetailsTVC") as! BookingDetailsTVC
                            bookingDetailsTVC.dictBookingDetails = self.dictBookingDetails
                            bookingDetailsTVC.remainingAmtDate = self.lblRemainingDateAndTime.text!
                            bookingDetailsTVC.isDeposit = self.isClickDeposit
                            if serverUrl == "api/booking"{
                                bookingDetailsTVC.isFrom = "Booked Successfully"
                            }else{
                                bookingDetailsTVC.isFrom = "Payment failed"
                            }
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
                    
                    if self!.isFromOffer == false {
                        let dict = self?.arrayUserDetails[(self?.selectedIndex)!]
                        DispatchQueue.main.async {
                            self!.chaletBooking(chaletId: "\((dict?.chalet_id!)!)", selectedPackage: self!.selectedPackage, checkIn: (dict?.check_in!)!, checkOut: (dict?.check_out!)!, deposit: self!.isClickDeposit == false ? "0" : (dict?.min_deposit!)!, rent: (dict?.rent!)!, totalPaid: self!.isClickDeposit == false ? (dict?.rent!)! : (dict?.min_deposit!)!,paymentGateway: (dataDict?.paymentGateway!)!,paymentId: (dataDict?.paymentID!)!,authId: (dataDict?.authorizationID!)!,trackId: (dataDict?.trackID!)!,transcationId: (dataDict?.transactionID)!,invoiceReference: executePaymentResponse.invoiceReference!,referenceId: (dataDict?.referenceID)!, serverUrl: "api/booking")
                        }
                    }else{
                        let dict = self!.dictOfferUserDetails
                        let dis = "\(dict!.min_deposit!)"
                        let ren = "\(dict!.rent!)"
                        DispatchQueue.main.async {
                            self!.chaletBooking(chaletId: "\((dict?.chalet_id!)!)", selectedPackage: self!.selectedPackage, checkIn: (dict?.check_in!)!, checkOut: (dict?.check_out!)!, deposit: self!.isClickDeposit == false ? "0" : dis, rent: ren, totalPaid: self!.isClickDeposit == false ? ren : dis,paymentGateway: (dataDict?.paymentGateway!)!,paymentId: (dataDict?.paymentID!)!,authId: (dataDict?.authorizationID!)!,trackId: (dataDict?.trackID!)!,transcationId: (dataDict?.transactionID)!,invoiceReference: executePaymentResponse.invoiceReference!,referenceId: (dataDict?.referenceID)!, serverUrl: "api/booking")
                        }
                    }
                }
            case .failure(let failError):
                print(failError)
                if self!.isUnpaidDone == true{
                    self!.isUnpaidDone = false
                    // showDefaultAlert(viewController: self!, title: "Message", msg: "Payment failed...!")
                    if  failError.errorDescription == "A server with the specified hostname could not be found." || failError.errorDescription == "Transaction not Captured!" {
                        
                        
                        if self!.isFromOffer == false {
                            let dict = self?.arrayUserDetails[(self?.selectedIndex)!]
                            DispatchQueue.main.async {
                                self!.chaletBooking(chaletId: "\((dict?.chalet_id!)!)", selectedPackage: self!.selectedPackage, checkIn: (dict?.check_in!)!, checkOut: (dict?.check_out!)!, deposit: self!.isClickDeposit == false ? "0" : (dict?.min_deposit!)!, rent: (dict?.rent!)!, totalPaid: self!.isClickDeposit == false ? (dict?.rent!)! : (dict?.min_deposit!)!,paymentGateway: "",paymentId: "",authId: "",trackId: "",transcationId: "",invoiceReference: "",referenceId: "", serverUrl: "api/paid_booking")
                            }
                        }else{
                            let dict = self!.dictOfferUserDetails
                            let dis = "\(dict!.min_deposit!)"
                            let ren = "\(dict!.rent!)"
                            DispatchQueue.main.async {
                                self!.chaletBooking(chaletId: "\((dict?.chalet_id!)!)", selectedPackage: self!.selectedPackage, checkIn: (dict?.check_in!)!, checkOut: (dict?.check_out!)!, deposit: self!.isClickDeposit == false ? "0" : dis, rent: ren, totalPaid: self!.isClickDeposit == false ? ren : dis,paymentGateway: "",paymentId: "",authId: "",trackId: "",transcationId: "",invoiceReference: "",referenceId: "", serverUrl: "api/paid_booking")
                            }
                        }
                        
                    }else{
                        showDefaultAlert(viewController: self!, title: "Message", msg: failError.errorDescription)
                        
                    }
                }
            }
    }
    
    }
    
     func getExecutePaymentRequest(paymentMethodId: Int) -> MFExecutePaymentRequest {
        
        var rent = ""
        if isClickDeposit == true{
            if isFromOffer == false {
                rent = self.arrayUserDetails[self.selectedIndex].min_deposit!
            }else{
                rent = "\(self.dictOfferUserDetails.min_deposit!)"
            }
            
        }else{
            if isFromOffer == false {
                rent = self.arrayUserDetails[self.selectedIndex].rent!
            }else{
                rent = "\(self.dictOfferUserDetails.rent!)"
            }
        }
        
        let invoiceValue = Decimal(string: rent ) ?? 0
        let request = MFExecutePaymentRequest(invoiceValue: invoiceValue , paymentMethod: paymentMethodId)
        //request.userDefinedField = ""
        if isFromOffer == false {
            request.customerEmail = self.arrayUserDetails[self.selectedIndex].email!// must be email
            request.customerMobile = self.arrayUserDetails[self.selectedIndex].phone!
            request.customerCivilId = self.arrayUserDetails[self.selectedIndex].civil_id!
            request.customerName = self.arrayUserDetails[self.selectedIndex].firstname!
            let address = MFCustomerAddress(block: "ddd", street: "sss", houseBuildingNo: "sss", address: "sss", addressInstructions: "sss")
            request.customerAddress = address
            request.customerReference = "Test MyFatoorah Reference"
        }else{
            request.customerEmail = self.dictOfferUserDetails.email!// must be email
            request.customerMobile = self.dictOfferUserDetails.phone!
            request.customerCivilId = self.dictOfferUserDetails.civil_id!
            request.customerName = self.dictOfferUserDetails.firstname!
            let address = MFCustomerAddress(block: "ddd", street: "sss", houseBuildingNo: "sss", address: "sss", addressInstructions: "sss")
            request.customerAddress = address
            request.customerReference = "Test MyFatoorah Reference"
        }
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
            DispatchQueue.main.async {
                self.checkBlockStatus()
            }
            if success {
                if ((response as! NSDictionary)["status"] as! Bool) == true {
                    
                    let jsonBase = AgreementListBase(dictionary: response as! NSDictionary)
                    self.arrayAgreements = (jsonBase?.agreement)!
                    DispatchQueue.main.async {
                        
                        self.collectionViewAgreement.reloadData()
                        self.tableView.reloadRows(at: [IndexPath(row: 6, section: 0)], with: .none)
                    }
                }else{
                    showDefaultAlert(viewController: self, title: "Message".localized(), msg: ((response as! NSDictionary)["message"] as! String))
                }
            }else{
                showDefaultAlert(viewController: self, title: "Message".localized(), msg: error!.localizedDescription)
            }
        }
    }
    
}
extension ReservationTVC {
    
    func showAuthPopup() {
        let window = UIApplication.shared.delegate?.window!
        blurView = UIView(frame: CGRect(x: 0, y: 0, width: window!.frame.size.width, height:  window!.frame.size.height))
        blurView.backgroundColor = UIColor(red: 0, green: 0, blue: 0, alpha: 0.7)
        window!.addSubview(blurView)
        self.tableView.isScrollEnabled = false
        let x = 15.0
            //(window!.frame.size.width - 275) / 2
        let y = (window!.frame.size.height - 180) / 2
        self.popUpSelectImage.frame = CGRect(x: 20.0, y: 100.0, width: (window?.frame.width)! - 40, height: 180)
        
        self.blurView.addSubview(self.popUpSelectImage)
        self.blurView.bringSubviewToFront(self.popUpSelectImage)
        self.popUpSelectImage.transform = CGAffineTransform(scaleX: 0.2, y: 0.2)
        
        UIView.animate(withDuration: 0.33, animations: {
            self.popUpSelectImage.transform = CGAffineTransform(scaleX: 1.0, y: 1.0)
            self.popUpSelectImage.layer.cornerRadius = 8.0
        })
    }
    
    func dismissPopUpView(){
        self.tableView.isScrollEnabled = true
        self.lblAgreementStr.text = ""
        UIView.animate(withDuration: 0.33, animations: {
            self.blurView.alpha = 0
        }, completion: { (completed) in
            
        })
        UIView.animate(withDuration: 0.33, delay: 0, usingSpringWithDamping: 1, initialSpringVelocity: 10, options: UIView.AnimationOptions(rawValue: 0), animations: {
            
        }, completion: { (completed) in
            self.blurView.removeFromSuperview()
            self.blurView = nil
        })
    }
    
    func showPlayerPopup(videourl:String) {
        let window = UIApplication.shared.delegate?.window!
        blurView = UIView(frame: CGRect(x: 0, y: 0, width: window!.frame.size.width, height:  window!.frame.size.height))
        blurView.backgroundColor = UIColor(red: 0, green: 0, blue: 0, alpha: 0.7)
        window!.addSubview(blurView)
        self.tableView.isScrollEnabled = false
        let x = 0
        //(window!.frame.size.width - 275) / 2
        let y = ((window!.frame.size.height ) / 2) - 200
        self.viewPlayer.frame = CGRect(x: 0, y: 30, width: window!.frame.size.width, height:  window!.frame.size.height)
        viewPlayer.backgroundColor = UIColor(red: 0, green: 0, blue: 0, alpha: 0.7)
        self.blurView.addSubview(self.viewPlayer)
        self.blurView.bringSubviewToFront(self.viewPlayer)
        //self.viewPlayer.transform = CGAffineTransform(scaleX: 0.2, y: 0.2)
        let playerController                = AVPlayerViewController()

        
        //UIView.animate(withDuration: 0.33, animations: {
            //self.viewPlayer.transform = CGAffineTransform(scaleX: 1.0, y: 1.0)
           // self.viewPlayer.layer.cornerRadius = 8.0
            
            DispatchQueue.main.async {
                let player = AVPlayer(url: URL(string: videourl.addingPercentEncoding(withAllowedCharacters: .urlFragmentAllowed)!)!)
                //let player = AVPlayer(url: URL(fileURLWithPath: path))
                playerController.player = player
                self.viewPlayer.addSubview(playerController.view)
                playerController.view.frame = CGRect(x: CGFloat(x), y: y, width: window!.frame.size.width - 20, height: 400)
                playerController.view.tintColor = kAppThemeColor
                playerController.player?.play()
                playerController.showsPlaybackControls = true
            }
       // })
        
    }
    
    
    
}
extension ReservationTVC {
    func getAdminDetails() {
        ServiceManager.sharedInstance.postMethodAlamofire("api/view_admin", dictionary: nil, withHud: true) { [self] (success, response, error) in
            DispatchQueue.main.async {
                self.getAgreementsDetails()
            }
            if success {
                if ((response as! NSDictionary)["status"] as! Bool) == true {
                    let jsonBase = AdminDetailsBase(dictionary: response as! NSDictionary)
                    self.arrayAdminDetails = (jsonBase?.admin_details)!
                }else{
                    showDefaultAlert(viewController: self, title: "Message".localized(), msg: ((response as! NSDictionary)["message"] as! String))
                }
            }else{
                showDefaultAlert(viewController: self, title: "Message".localized(), msg: error!.localizedDescription)
            }
            
        }
    }
    
    override func scrollViewDidScroll(_ scrollView: UIScrollView) {
        //NotificationCenter.default.post(name: NSNotification.Name(rawValue: NotificationNames.kStopVideoPlayer), object: nil, userInfo: nil)
    }
    func checkBlockStatus() {
        if CAUser.currentUser.id != nil {
            ServiceManager.sharedInstance.postMethodAlamofire("api/block_user", dictionary: ["userid": CAUser.currentUser.id!], withHud: true) { [self] (success, response, error) in
                if success {
                    let status = ((response as! NSDictionary)["status"] as! Bool)
                    if status{
                        self.isUSerIsBlocked = false
                    }else{
                        self.isUSerIsBlocked = true
                    }
                }else{
                    showDefaultAlert(viewController: self, title: "Message".localized(), msg: error!.localizedDescription)
                }
            }
        }
    }
}

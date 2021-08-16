//
//  BookingDetailsTVC.swift
//  AbyChaletApp
//
//  Created by Visakh Srishti on 18/05/21.
//

import UIKit
import DHSmartScreenshot
import MapKit
import GoogleMaps
import MediaPlayer
import AVKit

class BookingDetailsTVC: UITableViewController {

    @IBOutlet weak var viewBgDeposit: UIView!
    @IBOutlet weak var lblCollectionIndex: UILabel!
    @IBOutlet weak var viewCollectionIndex: UIView!
    @IBOutlet weak var viewMap: UIView!
    @IBOutlet weak var viewTopBooked: UIView!
    @IBOutlet weak var lblBooked: UILabel!
    @IBOutlet weak var viewBooked: UIView!

    @IBOutlet weak var viewBgCollectionView: UIView!
    @IBOutlet weak var collectionViewNew: UICollectionView!
    @IBOutlet weak var viewChalletName: UIView!
    @IBOutlet weak var lblSlNo: UILabel!
    @IBOutlet weak var lblChaletName: UILabel!
    @IBOutlet weak var viewCheckOutIn: UIView!
    
    @IBOutlet weak var lblCheckOutDate: UILabel!
    @IBOutlet weak var lblCheckInDate: UILabel!
    @IBOutlet weak var lblCheckOutTime: UILabel!
    @IBOutlet weak var lblCheckInTime: UILabel!
    @IBOutlet weak var viewBookingDetailsBottom: UIView!
    @IBOutlet weak var ViewBookingDetailsHeading: UIView!
    @IBOutlet weak var viewBookingDetails: UIView!
    @IBOutlet weak var viewLocation: UIView!
    @IBOutlet weak var viewLocationTop: UIView!
    
    @IBOutlet weak var lblReservationID: UILabel!
    @IBOutlet weak var lblRent: UILabel!
    @IBOutlet weak var lblDeposit: UILabel!
    @IBOutlet weak var lblRewards: UILabel!
    @IBOutlet weak var lblOffer: UILabel!
    @IBOutlet weak var lblTotal: UILabel!
    @IBOutlet weak var mapView: MKMapView!
    @IBOutlet weak var lblRemaining: UILabel!
    @IBOutlet weak var btnCopy: UIButton!
    
    @IBOutlet weak var lblDpRentalPrice: UILabel!
    @IBOutlet weak var lblDpDepositr: UILabel!
    @IBOutlet weak var lblDpRewards: UILabel!
    @IBOutlet weak var lblDpOffer: UILabel!
    @IBOutlet weak var lblDpTotalPaid: UILabel!
    @IBOutlet weak var lblDpRemaining: UILabel!
    @IBOutlet weak var lblDpRemainingDate: UILabel!
    @IBOutlet weak var lblBookStatus: UILabel!
    
    
    var selectedIndex : Int!
    var collectionIndex = 0
    var arrayUserDetails = [User_details]()
    var dictBookingDetails : Booking_details!
    let annotation = MKPointAnnotation()
    var lblIndexValue = 1
    var isDeposit = true
    var remainingAmtDate = ""
    var isFrom = ""
    override func viewDidLoad() {
        super.viewDidLoad()

        self.setUpNavigationBar()
        self.setupUI()
        if dictBookingDetails != nil {
            self.setValuesToFields()
            mapView.delegate = self
            //annotation.coordinate = CLLocationCoordinate2D(latitude: 46.41434149999999903002390055917203426361083984375, longitude: 29.311784599999999301189745892770588397979736328125)
            // mapView.setCenter(CLLocationCoordinate2D(latitude: 46.41434149999999903002390055917203426361083984375, longitude: 29.311784599999999301189745892770588397979736328125), animated: true)
            annotation.coordinate = CLLocationCoordinate2D(latitude: dictBookingDetails.longitude!, longitude: dictBookingDetails.latitude!)
            mapView.setCenter(CLLocationCoordinate2D(latitude: dictBookingDetails.longitude!, longitude: dictBookingDetails.latitude!), animated: true)
            mapView.addAnnotation(annotation)
        }
    }
    
    override func viewWillAppear(_ animated: Bool) {
        /*DispatchQueue.main.async {
            
            let camera = GMSCameraPosition.camera(withLatitude: 8.446780, longitude: 77.056380, zoom: 6.0)
            let mapView = GMSMapView.map(withFrame: self.viewMap.frame, camera: camera)

           let marker = GMSMarker(position: CLLocationCoordinate2D(latitude: 8.446780, longitude: 77.056380))
           
           marker.map = mapView
           self.viewMap.addSubview(mapView)
        }*/
        NotificationCenter.default.addObserver(self, selector: #selector(logoutUser), name: NSNotification.Name(rawValue: NotificationNames.kBlockedUser), object: nil)
            appDelegate.checkBlockStatus()
    }
    @objc func logoutUser() {
        appDelegate.logOut()
    }

    override func viewDidLayoutSubviews() {
        self.viewTopBooked.roundCorners(corners: [.topLeft,.topRight], radius: 10.0)
        self.viewBgCollectionView.roundCorners(corners: [.bottomLeft,.bottomRight], radius: 10.0)
        self.viewChalletName.roundCorners(corners: [.topLeft,.topRight], radius: 10.0)
        self.viewBookingDetails.roundCorners(corners: [.topLeft,.topRight], radius: 10.0)
        self.viewBookingDetails.roundCorners(corners: [.bottomLeft,.bottomRight], radius: 10.0)
        self.viewLocationTop.roundCorners(corners: [.topLeft,.topRight], radius: 10.0)
        self.ViewBookingDetailsHeading.roundCorners(corners: [.topLeft,.topRight], radius: 10.0)
        
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
        self.navigationItem.title = "Thank You"
        
    }
    //MARK:- SetupUI
    func setupUI()  {
        self.viewBooked.addCornerForView(cornerRadius: 10.0)
        self.viewCheckOutIn.addCornerForView(cornerRadius: 10.0)
        self.viewLocation.addCornerForView(cornerRadius: 10.0)
        self.viewBookingDetails.addCornerForView(cornerRadius: 10.0)
        self.viewBgDeposit.addCornerForView(cornerRadius: 10.0)

        let width = kScreenWidth - 30
        let columnLayout10 = ColumnFlowLayout.init(cellsPerRow: 1, minimumInteritemSpacing: 0.0, minimumLineSpacing: 0.0, sectionInset: UIEdgeInsets(top: 0, left: 0, bottom: 0, right: 0), cellHeight: 315, cellWidth: width,scrollDirec: .horizontal)
        collectionViewNew?.collectionViewLayout = columnLayout10
    }
    
    //MARK:- SetValuesToFields
    func setValuesToFields() {
        self.lblSlNo.text =  "No. \(dictBookingDetails.id ?? 0)"
        self.lblChaletName.text = dictBookingDetails.chalet_name!
        self.lblReservationID.text = dictBookingDetails.reservation_id!
        self.lblCheckOutDate.text = dictBookingDetails.check_out?.appFormattedDate
        self.lblCheckOutTime.text = dictBookingDetails.checkout_time!
        self.lblCheckInDate.text = dictBookingDetails.check_in!.appFormattedDate
        self.lblCheckInTime.text = dictBookingDetails.checkin_time!
        self.lblRent.text = "KD \(dictBookingDetails.rent!)"
        self.lblDeposit.text = "KD \(dictBookingDetails.deposit!)"
        self.lblRewards.text = "KD \(dictBookingDetails.reward_discount!)"
        self.lblOffer.text = "KD \(dictBookingDetails.offer_discount!)"
        self.lblTotal.text = "KD \(dictBookingDetails.total_paid!)"
        self.lblRemaining.text = "KD \(dictBookingDetails.remaining!)"
        self.lblCollectionIndex.text = "\(lblIndexValue)/\(String(describing: (dictBookingDetails.chalet_upload!.count)))"
        self.lblDpRentalPrice.text = "KD \(dictBookingDetails.rent!)"
        self.lblDpDepositr.text = "KD \(dictBookingDetails.deposit!)"
        self.lblDpRewards.text = "KD \(dictBookingDetails.reward_discount!)"
        self.lblDpOffer.text = "KD \(dictBookingDetails.offer_discount!)"
        self.lblDpTotalPaid.text = "KD \(dictBookingDetails.total_paid!)"
        self.lblDpRemaining.text = "KD \(dictBookingDetails.remaining!)"
        
        
        /*let dateFormater = DateFormatter()
        dateFormater.dateFormat = "yyyy-MM-dd hh:mm a"
        let checkinDate = dateFormater.date(from: "\(String(describing: dictBookingDetails.check_in!)) \(String(describing: dictBookingDetails.checkin_time!))")
        //let difference = Calendar.current.dateComponents([.hour], from: Date(), to: checkinDate!)
        let remaingTimeToPay = Int(arrayBookingDetails!.remaining_amt_pay!)
        
        let wedDate = Calendar.current.date( byAdding: .hour,value: -remaingTimeToPay!,to: checkinDate!)
        dateFormater.dateFormat = "dd/MM/yyyy ( hh:mm a )"*/
        
        self.lblDpRemainingDate.text = remainingAmtDate
        if isFrom == "Booked Successfully" {
            self.lblBookStatus.text = "Booked Successfully"
        }else{
            self.lblBookStatus.text = "Payment failed"
        }
        
    }

    //MARK:- ButtonActions
    //MARK:- Done button action keyboard
    @objc func doneButtonClicked() {
        self.view.endEditing(true)
    }
    @objc func notificationButtonTouched()  {
        
        
    }
    @IBAction func btnShareToWhatsapAction(_ sender: Any) {
        
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
    
    @IBAction func btnPrevActionCollectioView(_ sender: Any) {
        
        if collectionIndex != 0 {
            collectionIndex = collectionIndex - 1
            lblIndexValue = lblIndexValue - 1
            self.lblCollectionIndex.text = "\(lblIndexValue)/\(String(describing: (dictBookingDetails.chalet_upload!.count)))"
            collectionViewNew.scrollToItem(at: IndexPath(item: collectionIndex, section: 0), at: .centeredHorizontally, animated: true)
        }
        
    }
    @IBAction func btnForwardvActionCollectioView(_ sender: Any) {
        
        if collectionIndex != (dictBookingDetails.chalet_upload!.count - 1) {
            collectionIndex = collectionIndex + 1
            lblIndexValue = lblIndexValue + 1
            self.lblCollectionIndex.text = "\(lblIndexValue)/\(String(describing: (dictBookingDetails.chalet_upload!.count)))"
            collectionViewNew.scrollToItem(at: IndexPath(item: collectionIndex, section: 0), at: .centeredHorizontally, animated: true)
            
        }
        
    }
    @IBAction func btnCopyAction(_ sender: UIButton) {
        
        sender.setTitle("Copied", for: .normal)
        UIPasteboard.general.string = dictBookingDetails.location!
        Timer.scheduledTimer(timeInterval: 3, target: self, selector: #selector(didTimerComplete), userInfo: nil, repeats: false)
        
    }
    
    @objc private func didTimerComplete() {
        btnCopy.setTitle("Copy", for: .normal)
    }
    
    @IBAction func btnClickMapAction(_ sender: UIButton) {
        if (UIApplication.shared.canOpenURL(URL(string:"comgooglemaps://")!)) {
            UIApplication.shared.open(URL(string:"comgooglemaps://?center=\(dictBookingDetails.longitude!),\(dictBookingDetails.latitude!)&zoom=14&views=traffic&q=\(dictBookingDetails.longitude!),\(dictBookingDetails.latitude!)")!, options: [:], completionHandler: nil)
        } else {
            print("Can't use comgooglemaps://")
        }
    }
    
    @IBAction func btnPlayVideoAction(_ sender: UIButton) {
        
        let urlStr =  dictBookingDetails.chalet_upload![sender.tag].file_name!
           // self.showPlayerPopup(videourl: urlStr)
        let videoUrl = URL(string: urlStr.addingPercentEncoding(withAllowedCharacters: .urlFragmentAllowed)!)!
            let player = AVPlayer(url: videoUrl)
            let playerViewController = AVPlayerViewController()
            playerViewController.player = player
            self.present(playerViewController, animated: true) {
                playerViewController.player!.play()
            }
        
    }
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        
        if isDeposit == true{
            if indexPath.row == 3{
                return 0
            }else if indexPath.row == 4{
                return 556
            }
        }else{
            if indexPath.row == 3{
                return 296
            }else if indexPath.row == 4{
                return 0

            }
        }
        return super.tableView(tableView, heightForRowAt: indexPath)
    }
    
}
extension BookingDetailsTVC : UICollectionViewDelegate, UICollectionViewDataSource {
    
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        return dictBookingDetails.chalet_upload?.count ?? 0
    }
    
    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        let arr = dictBookingDetails.chalet_upload!
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
            cell.playVideo(videourl: arr[indexPath.item].file_name!, previewImage: "")
            cell.btnPlay.tag = indexPath.item
            return cell
        }
    }
}
extension BookingDetailsTVC : MKMapViewDelegate {
    
    private func mapView(mapView: MKMapView, viewForAnnotation annotation: MKAnnotation) -> MKAnnotationView? {
        if annotation is MKUserLocation{
            return nil;
        }else{
            let pinIdent = "Pin";
            var pinView: MKPinAnnotationView;
            if let dequeuedView = mapView.dequeueReusableAnnotationView(withIdentifier: pinIdent) as? MKPinAnnotationView {
                dequeuedView.annotation = annotation;
                pinView = dequeuedView;
            }else{
                pinView = MKPinAnnotationView(annotation: annotation, reuseIdentifier: pinIdent);
                
            }
            return pinView;
        }
    }
    
    func mapView(_ mapView: MKMapView, didSelect view: MKAnnotationView){
        if (UIApplication.shared.canOpenURL(URL(string:"comgooglemaps://")!)) {
            UIApplication.shared.open(URL(string:"comgooglemaps://?center=\(String(describing: view.annotation!.coordinate.latitude)),\(String(describing: view.annotation!.coordinate.longitude))&zoom=14&views=traffic&q=\(String(describing: view.annotation!.coordinate.latitude)),\(String(describing: view.annotation!.coordinate.longitude))")!, options: [:], completionHandler: nil)
        } else {
            print("Can't use comgooglemaps://")
        }
    }
}

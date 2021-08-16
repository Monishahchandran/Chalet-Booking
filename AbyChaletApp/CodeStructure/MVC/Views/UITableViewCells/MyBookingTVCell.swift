//
//  MyBookingTVCell.swift
//  AbyChaletApp
//
//  Created by Visakh Srishti on 24/05/21.
//

import UIKit
import MapKit
import SDWebImage
import KDCircularProgress


class MyBookingTVCell: UITableViewCell {
    @IBOutlet weak var viewBg: UIView!
    override func awakeFromNib() {
        super.awakeFromNib()
        self.viewBg.addCornerForView(cornerRadius: 10)
    }

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

        
    }
    
    

}
class NoBookingTVCell: UITableViewCell {

    @IBOutlet weak var viewBg: UIView!

    
    override func awakeFromNib() {
        super.awakeFromNib()
        self.viewBg.addCornerForView(cornerRadius: 10)
    }

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

        
    }

}
class BookingRewardsTVCell: UITableViewCell {

    @IBOutlet weak var viewBg: UIView!
    @IBOutlet weak var viewBottom: UIView!
    @IBOutlet weak var lblEarn: UILabel!
    @IBOutlet weak var lblSpent: UILabel!
    @IBOutlet weak var lblTotalRewards: UILabel!
    @IBOutlet weak var lblTotalRewardsMessage: UILabel!
    @IBOutlet weak var progressView: UIView!
    @IBOutlet weak var lblEarnRewards: UILabel!
    var progress: KDCircularProgress!

    
    override func awakeFromNib() {
        super.awakeFromNib()
        self.viewBg.addCornerForView(cornerRadius: 10)
        
        let gradientImage = UIImage.gradientImageWithBounds(bounds: lblEarnRewards.bounds, colors: [#colorLiteral(red: 1, green: 0.8431372549, blue: 0, alpha: 1), #colorLiteral(red: 1, green: 0.2705882353, blue: 0, alpha: 1)])
        lblEarnRewards.textColor = UIColor.init(patternImage: gradientImage)


        
    }

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)
        //self.viewBottom.roundCorners(corners: [.bottomLeft,.bottomRight], radius: 10.0)
        
    }
    
    func setValuesToFields(dictReward:Reward_details) {
        
        let attrsWhatKindOfJob1 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Regular", size: 16)!, NSAttributedString.Key.foregroundColor : UIColor("#1E4355")] as [NSAttributedString.Key : Any]
        let attrsWhatKindOfJob2 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Bold", size: 17)!, NSAttributedString.Key.foregroundColor : UIColor("#379F00")] as [NSAttributedString.Key : Any]
        let attrsWhatKindOfJob3 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Bold", size: 16)!, NSAttributedString.Key.foregroundColor : UIColor("#379BF2")] as [NSAttributedString.Key : Any]
        let attrsWhatKindOfJob4 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Regular", size: 13)!, NSAttributedString.Key.foregroundColor : UIColor("#B10622")] as [NSAttributedString.Key : Any]
        let attrsWhatKindOfJob5 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Bold", size: 14)!, NSAttributedString.Key.foregroundColor : UIColor("#B10622")] as [NSAttributedString.Key : Any]
        let attrsWhatKindOfJob6 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Bold", size: 16)!, NSAttributedString.Key.foregroundColor : dictReward.rewarded_amt != "" ?   UIColor("#379F00") : UIColor("#A8A8A8")] as [NSAttributedString.Key : Any]
        
        
        let attributedStringEarn1 = NSMutableAttributedString(string:"Earn ", attributes:attrsWhatKindOfJob1)
        let attributedStringEarn2 = NSMutableAttributedString(string:"\(dictReward.reward_earn ?? "") ", attributes:attrsWhatKindOfJob2)
        let attributedStringEarn3 = NSMutableAttributedString(string:"KD ", attributes:attrsWhatKindOfJob1)
        attributedStringEarn1.append(attributedStringEarn2)
        attributedStringEarn1.append(attributedStringEarn3)
        self.lblEarn.attributedText = attributedStringEarn1
        
        let attributedStringSpent1 = NSMutableAttributedString(string:"On every ", attributes:attrsWhatKindOfJob1)
        let attributedStringSpent2 = NSMutableAttributedString(string:"\(dictReward.every_spend ?? "") ", attributes:attrsWhatKindOfJob3)
        let attributedStringSpent3 = NSMutableAttributedString(string:"KD spent ", attributes:attrsWhatKindOfJob1)
        attributedStringSpent1.append(attributedStringSpent2)
        attributedStringSpent1.append(attributedStringSpent3)
        lblSpent.attributedText = attributedStringSpent1

        let attributedStringRewards1 = NSMutableAttributedString(string:"Must be used Total ", attributes:attrsWhatKindOfJob4)
        let attributedStringRewards2 = NSMutableAttributedString(string:"Rewards before ", attributes:attrsWhatKindOfJob5)
        let attributedStringRewards3 = NSMutableAttributedString(string:"the end of the year", attributes:attrsWhatKindOfJob4)
        attributedStringRewards1.append(attributedStringRewards2)
        attributedStringRewards1.append(attributedStringRewards3)
        lblTotalRewardsMessage.attributedText = attributedStringRewards1
        
        let attributedStringTotalRewards = NSMutableAttributedString(string:"Total Rewards : \(dictReward.rewarded_amt ?? "") KD", attributes:attrsWhatKindOfJob6)
        lblTotalRewards.attributedText = attributedStringTotalRewards
    }
    
    //MARK:- Setup ProgressBar
    func setupProgressBar(dictReward:Reward_details) {
        progressView.backgroundColor = .clear
        progress = KDCircularProgress(frame: CGRect(x: 0, y: 0, width: 90, height: 90))
        progress.startAngle = -90
        progress.progressThickness = 0.2
        progress.trackThickness = 0.4
        progress.trackColor = #colorLiteral(red: 0.6666666865, green: 0.6666666865, blue: 0.6666666865, alpha: 0.2904536448)
        progress.backgroundColor = .clear
        progress.clockwise = true
        progress.gradientRotateSpeed = 2
        progress.roundedCorners = true
        progress.glowMode = .forward
        progress.glowAmount = 0.5
        progress.set(colors: #colorLiteral(red: 1, green: 0.8431372549, blue: 0, alpha: 1),#colorLiteral(red: 1, green: 0.8431372549, blue: 0, alpha: 1), #colorLiteral(red: 1, green: 0.2705882353, blue: 0, alpha: 1))
        self.progressView.addSubview(progress)
        
        
        
        
        if dictReward.total != 0 {
            
            let totolD = Double(dictReward.total!)
            
            if totolD > 2000 || totolD < 2000{
                let everySpend = Double(dictReward.every_spend!)
                let total = totolD / everySpend!
                let new = total.truncatingRemainder(dividingBy: 1.0)
                let rounded = Double(round(1000*new)/1000)
                let inPercentage = rounded * 100
                if inPercentage > 0 {
                    let angle = 3.6*inPercentage
                    let earnRewards = rounded * everySpend!
                    self.lblEarnRewards.text = "\(earnRewards.clean) KD"
                    progress.angle = angle
                    if angle >= 360 {
                        //self.updateRewardDetails(rewardAmount: "\(dictReward.rewarded_amt!)", reservationAmount: "\(dictReward.total!)")
                    }
                }else{
                    progress.angle = 360
                    self.lblEarnRewards.text = "\(2000) KD"
                    //self.updateRewardDetails(rewardAmount: "\(dictReward.rewarded_amt!)", reservationAmount: "\(dictReward.total!)")
                }
            }else if totolD == 2000{
                progress.angle = 360
                self.lblEarnRewards.text = "\(2000) KD"
                //self.updateRewardDetails(rewardAmount: "\(dictReward.rewarded_amt!)", reservationAmount: "\(dictReward.total!)")
                
            }else {
                progress.angle = 0
                self.lblEarnRewards.text = "\(0) KD"
            }
            
            
        }
        
    }
    
    //MARK:- updateRewardDetails
    func updateRewardDetails(rewardAmount:String,reservationAmount:String) {
       /* ServiceManager.sharedInstance.postMethodAlamofire("api/reward_count", dictionary: ["userid":CAUser.currentUser.id!,"reward_amount":rewardAmount,"reservation_amt":reservationAmount], withHud: true) { (success, response, error) in
            if success {
                
            }
        }*/
    }


}

class InActiveBookingTVCell: UITableViewCell {
    
    
    @IBOutlet weak var viewBg: UIView!
    @IBOutlet weak var lblSlNo: UILabel!
    @IBOutlet weak var lblChaletName: UILabel!
    @IBOutlet weak var lblRent: UILabel!
    @IBOutlet weak var lblCheckOutDate: UILabel!
    @IBOutlet weak var lblCheckInDate: UILabel!
    @IBOutlet weak var lblCheckOutTime: UILabel!
    @IBOutlet weak var lblCheckInTime: UILabel!
    @IBOutlet weak var imgChaletImage: UIImageView!
    @IBOutlet weak var lblStatus: UILabel!
    @IBOutlet weak var lblBookingId: UILabel!
    
    override func awakeFromNib() {
        super.awakeFromNib()
        
    }

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)
        //self.viewBottom.roundCorners(corners: [.bottomLeft,.bottomRight], radius: 10.0)
        
    }
    func setValuesToFields(dict:MyBooking_details) {
        let arrayBookingDetails = dict.myBookingChalet_details?.first
        self.lblSlNo.text = "No.\(arrayBookingDetails?.chalet_id! ?? 0)"
        self.lblChaletName.text = arrayBookingDetails?.chalet_name!
        self.imgChaletImage.sd_setImage(with: URL(string: (arrayBookingDetails?.cover_photo!)!), placeholderImage: kPlaceHolderImage, options: .highPriority, completed: nil)
        self.lblRent.text = dict.rent!
        self.lblCheckOutDate.text = convertDateFormat(dateStr: dict.check_out!)
        self.lblCheckOutTime.text = dict.admincheck_out!
        self.lblCheckInDate.text = convertDateFormat(dateStr: dict.check_in!)
        self.lblCheckInTime.text = dict.admincheck_in!
        self.lblBookingId.text = dict.reservation_id!
        self.lblStatus.text = "Not Active"
    }
}
class NotAvailableBookingTVCell: UITableViewCell {
    
    
    @IBOutlet weak var viewBg: UIView!
    @IBOutlet weak var lblSlNo: UILabel!
    @IBOutlet weak var lblChaletName: UILabel!
    @IBOutlet weak var lblRent: UILabel!
    @IBOutlet weak var lblCheckOutDate: UILabel!
    @IBOutlet weak var lblCheckInDate: UILabel!
    @IBOutlet weak var lblCheckOutTime: UILabel!
    @IBOutlet weak var lblCheckInTime: UILabel!
    @IBOutlet weak var imgChaletImage: UIImageView!
    @IBOutlet weak var lblStatus: UILabel!
    @IBOutlet weak var lblBookingId: UILabel!
    
    override func awakeFromNib() {
        super.awakeFromNib()
        
    }

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)
        //self.viewBottom.roundCorners(corners: [.bottomLeft,.bottomRight], radius: 10.0)
        
    }
    func setValuesToFields(dict:MyBooking_details) {
        
        let arrayBookingDetails = dict.myBookingChalet_details?.first
        self.lblSlNo.text = "No.\(arrayBookingDetails?.chalet_id! ?? 0)"
        self.lblChaletName.text = arrayBookingDetails?.chalet_name!
        self.imgChaletImage.sd_setImage(with: URL(string: (arrayBookingDetails?.cover_photo!)!), placeholderImage: kPlaceHolderImage, options: .highPriority, completed: nil)
        self.lblRent.text = dict.rent!
        self.lblCheckOutDate.text = convertDateFormat(dateStr: dict.check_out!)
        self.lblCheckOutTime.text = dict.admincheck_out!
        self.lblCheckInDate.text = convertDateFormat(dateStr: dict.check_in!)
        self.lblCheckInTime.text = dict.admincheck_in!
        self.lblBookingId.text = dict.reservation_id!
        self.lblStatus.text = "Not Available"
    }
}
class ActiveBookingTVCell: UITableViewCell, MKMapViewDelegate {
    
    @IBOutlet weak var mapView: MKMapView!
    @IBOutlet weak var btnCopy: UIButton!
    @IBOutlet weak var btnClickMap : UIButton!
    @IBOutlet weak var viewBg: UIView!
    @IBOutlet weak var lblSlNo: UILabel!
    @IBOutlet weak var lblChaletName: UILabel!
    @IBOutlet weak var lblRent: UILabel!
    @IBOutlet weak var lblCheckOutDate: UILabel!
    @IBOutlet weak var lblCheckInDate: UILabel!
    @IBOutlet weak var lblCheckOutTime: UILabel!
    @IBOutlet weak var lblCheckInTime: UILabel!
    @IBOutlet weak var imgChaletImage: UIImageView!
    @IBOutlet weak var lblStatus: UILabel!
    @IBOutlet weak var lblBookingId: UILabel!
    let annotation = MKPointAnnotation()
    override func awakeFromNib() {
        super.awakeFromNib()
        
    }

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)
        //self.viewBottom.roundCorners(corners: [.bottomLeft,.bottomRight], radius: 10.0)
        
    }
    func setValuesToFields(dict:MyBooking_details) {
        
        let arrayBookingDetails = dict.myBookingChalet_details?.first
        self.lblSlNo.text = "No.\(arrayBookingDetails?.chalet_id! ?? 0)"
        self.lblChaletName.text = arrayBookingDetails?.chalet_name!
        self.imgChaletImage.sd_setImage(with: URL(string: (arrayBookingDetails?.cover_photo!)!), placeholderImage: kPlaceHolderImage, options: .highPriority, completed: nil)
        self.lblRent.text = dict.rent!
        
        self.lblCheckOutDate.text = convertDateFormat(dateStr: dict.check_out!)
        self.lblCheckOutTime.text = dict.admincheck_out!
        self.lblCheckInDate.text = convertDateFormat(dateStr: dict.check_in!)
            //dict.check_in!
        self.lblCheckInTime.text = dict.admincheck_in!
        self.lblBookingId.text = dict.reservation_id!
        self.lblStatus.text = "Active"
        
        let lat = Double(arrayBookingDetails!.longitude!)
        let long = Double(arrayBookingDetails!.latitude!)
        
        if lat != nil && long != nil {
            mapView.delegate = self
            annotation.coordinate = CLLocationCoordinate2D(latitude: lat!, longitude: long!)
            mapView.setCenter(CLLocationCoordinate2D(latitude: lat!, longitude: long!), animated: true)
            mapView.addAnnotation(annotation)
        }
        
    }
    
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
    
    func convertDateFormat(dateStr:String) -> String {
        var dateString = ""
        let dateFormatter = DateFormatter()
        dateFormatter.dateFormat = "yyyy-MM-dd"
        let date = dateFormatter.date(from: dateStr)
        dateFormatter.dateFormat = "dd/MM/yyyy"
        dateString = dateFormatter.string(from: date!)
        return dateString
    }
    
    
}
class AwaitingBookingTVCell: UITableViewCell {
    
    
    @IBOutlet weak var viewBg: UIView!
    @IBOutlet weak var lblSlNo: UILabel!
    @IBOutlet weak var lblChaletName: UILabel!
    @IBOutlet weak var lblRent: UILabel!
    @IBOutlet weak var lblCheckOutDate: UILabel!
    @IBOutlet weak var lblCheckInDate: UILabel!
    @IBOutlet weak var lblCheckOutTime: UILabel!
    @IBOutlet weak var lblCheckInTime: UILabel!
    @IBOutlet weak var imgChaletImage: UIImageView!
    @IBOutlet weak var lblStatus: UILabel!
    @IBOutlet weak var lblBookingId: UILabel!
    @IBOutlet weak var lblReaminingAmt: UILabel!
    @IBOutlet weak var lblRemainingDateTime: UILabel!
    @IBOutlet weak var btnPay: UIButton!
    override func awakeFromNib() {
        super.awakeFromNib()
        btnPay.titleLabel?.text = "Payment now".localized()
    }

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)
        //self.viewBottom.roundCorners(corners: [.bottomLeft,.bottomRight], radius: 10.0)
        
    }
    func setValuesToFields(dict:MyBooking_details) {
        
        let arrayBookingDetails = dict.myBookingChalet_details?.first
        self.lblSlNo.text = "No.\(arrayBookingDetails?.chalet_id! ?? 0)"
        self.lblChaletName.text = arrayBookingDetails?.chalet_name!
        self.imgChaletImage.sd_setImage(with: URL(string: (arrayBookingDetails?.cover_photo!)!), placeholderImage: kPlaceHolderImage, options: .highPriority, completed: nil)
        self.lblRent.text = dict.rent!
        self.lblCheckOutDate.text = convertDateFormat(dateStr: dict.check_out!)
        self.lblCheckOutTime.text = dict.admincheck_out!
        self.lblCheckInDate.text = convertDateFormat(dateStr: dict.check_in!)
        self.lblCheckInTime.text = dict.admincheck_in!
        self.lblBookingId.text = dict.reservation_id!
        //self.lblStatus.text = "Active"
        let rent = Int(dict.rent!)
        let totalPaid = Int(dict.total_paid!)
        let remainingAmt : Int = Int(rent! - totalPaid!)
        self.lblReaminingAmt.text = "KD \(remainingAmt)"
        //self.lblRemainingDateTime.text = "\(dict.check_in!) (\(dict.admincheck_in!))"
        
        
        let dateFormater = DateFormatter()
        dateFormater.dateFormat = "yyyy-MM-dd hh:mm a"
        let checkinDate = dateFormater.date(from: "\(String(describing: dict.check_in!)) \(String(describing: dict.admincheck_in!))")
        //let difference = Calendar.current.dateComponents([.hour], from: Date(), to: checkinDate!)
        let remaingTimeToPay = Int(arrayBookingDetails!.remaining_amt_pay!)
        
        let wedDate = Calendar.current.date( byAdding: .hour,value: -remaingTimeToPay!,to: checkinDate!)
        dateFormater.dateFormat = "dd/MM/yyyy ( hh:mm a )"
        lblRemainingDateTime.text = dateFormater.string(from: wedDate!)

        
        
    }
}

class CancelledBookingTVCell: UITableViewCell {
    
    @IBOutlet weak var lblSlNo: UILabel!
    @IBOutlet weak var lblChaletName: UILabel!
    @IBOutlet weak var lblRent: UILabel!
    @IBOutlet weak var lblCheckOutDate: UILabel!
    @IBOutlet weak var lblCheckInDate: UILabel!
    @IBOutlet weak var lblCheckOutTime: UILabel!
    @IBOutlet weak var lblCheckInTime: UILabel!
    @IBOutlet weak var imgChaletImage: UIImageView!
    @IBOutlet weak var lblStatus: UILabel!
    @IBOutlet weak var lblBookingId: UILabel!
    
    func setValuesToFields(dict:MyBooking_details) {
        
        let arrayBookingDetails = dict.myBookingChalet_details?.first
        self.lblSlNo.text = "No.\(arrayBookingDetails?.chalet_id! ?? 0)"
        self.lblChaletName.text = arrayBookingDetails?.chalet_name!
        //self.imgChaletImage.sd_setImage(with: URL(string: (arrayBookingDetails?.cover_photo!)!), placeholderImage: kPlaceHolderImage, options: .highPriority, completed: nil)
        self.lblRent.text = dict.rent!
        self.lblCheckOutDate.text = convertDateFormat(dateStr: dict.check_out!)
        self.lblCheckOutTime.text = dict.admincheck_out!
        self.lblCheckInDate.text = convertDateFormat(dateStr: dict.check_in!)
        self.lblCheckInTime.text = dict.admincheck_in!
        self.lblBookingId.text = dict.reservation_id!
        
    }
}

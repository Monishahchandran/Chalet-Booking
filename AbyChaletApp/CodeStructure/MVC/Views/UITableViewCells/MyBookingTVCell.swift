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
        let attrsWhatKindOfJob6 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Bold", size: 16)!, NSAttributedString.Key.foregroundColor : dictReward.rewarded_amt != 0 ?   UIColor("#379F00") : UIColor("#A8A8A8")] as [NSAttributedString.Key : Any]
        
        
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
        
        let attributedStringTotalRewards = NSMutableAttributedString(string:"Total Rewards : \(dictReward.rewarded_amt ?? 0) KD", attributes:attrsWhatKindOfJob6)
        lblTotalRewards.attributedText = attributedStringTotalRewards
    }
    
    //MARK:- Setup ProgressBar
    func setupProgressBar() {
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
        //progress.center = CGPoint(x: progressView.center.x, y: progressView.center.y)
        progress.angle = 125
        self.progressView.addSubview(progress)
        
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
        self.lblSlNo.text = "\(arrayBookingDetails?.chalet_id! ?? 0)"
        self.lblChaletName.text = arrayBookingDetails?.chalet_name!
        self.imgChaletImage.sd_setImage(with: URL(string: (arrayBookingDetails?.profile_pic!)!), placeholderImage: kPlaceHolderImage, options: .highPriority, completed: nil)
        self.lblRent.text = dict.rent!
        self.lblCheckOutDate.text = dict.check_out!
        self.lblCheckOutTime.text = dict.admincheck_out!
        self.lblCheckInDate.text = dict.check_in!
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
        self.lblSlNo.text = "\(arrayBookingDetails?.chalet_id! ?? 0)"
        self.lblChaletName.text = arrayBookingDetails?.chalet_name!
        self.imgChaletImage.sd_setImage(with: URL(string: (arrayBookingDetails?.profile_pic!)!), placeholderImage: kPlaceHolderImage, options: .highPriority, completed: nil)
        self.lblRent.text = dict.rent!
        self.lblCheckOutDate.text = dict.check_out!
        self.lblCheckOutTime.text = dict.admincheck_out!
        self.lblCheckInDate.text = dict.check_in!
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
        self.lblSlNo.text = "\(arrayBookingDetails?.chalet_id! ?? 0)"
        self.lblChaletName.text = arrayBookingDetails?.chalet_name!
        self.imgChaletImage.sd_setImage(with: URL(string: (arrayBookingDetails?.cover_photo!)!), placeholderImage: kPlaceHolderImage, options: .highPriority, completed: nil)
        self.lblRent.text = dict.rent!
        self.lblCheckOutDate.text = dict.check_out!
        self.lblCheckOutTime.text = dict.admincheck_out!
        self.lblCheckInDate.text = dict.check_in!
        self.lblCheckInTime.text = dict.admincheck_in!
        self.lblBookingId.text = dict.reservation_id!
        self.lblStatus.text = "Active"
        
        if arrayBookingDetails != nil {
            mapView.delegate = self
            annotation.coordinate = CLLocationCoordinate2D(latitude: arrayBookingDetails!.latitude!, longitude: arrayBookingDetails!.longitude!)
            mapView.setCenter(CLLocationCoordinate2D(latitude: arrayBookingDetails!.latitude!, longitude: arrayBookingDetails!.longitude!), animated: true)
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
        
    }

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)
        //self.viewBottom.roundCorners(corners: [.bottomLeft,.bottomRight], radius: 10.0)
        
    }
    func setValuesToFields(dict:MyBooking_details) {
        
        let arrayBookingDetails = dict.myBookingChalet_details?.first
        self.lblSlNo.text = "\(arrayBookingDetails?.chalet_id! ?? 0)"
        self.lblChaletName.text = arrayBookingDetails?.chalet_name!
        self.imgChaletImage.sd_setImage(with: URL(string: (arrayBookingDetails?.profile_pic!)!), placeholderImage: kPlaceHolderImage, options: .highPriority, completed: nil)
        self.lblRent.text = dict.rent!
        self.lblCheckOutDate.text = dict.check_out!
        self.lblCheckOutTime.text = dict.admincheck_out!
        self.lblCheckInDate.text = dict.check_in!
        self.lblCheckInTime.text = dict.admincheck_in!
        self.lblBookingId.text = dict.reservation_id!
        //self.lblStatus.text = "Active"
        let rent = Int(dict.rent!)
        let totalPaid = Int(dict.total_paid!)
        let remainingAmt : Int = Int(rent! - totalPaid!)
        self.lblReaminingAmt.text = "\(remainingAmt) KD"
        self.lblRemainingDateTime.text = "\(dict.check_in!) (\(dict.admincheck_in!))"
        
    }
}

//
//  InboxListTVCell.swift
//  AbyChaletApp
//
//  Created by Visakh Srishti on 30/05/21.
//

import UIKit
import SDWebImage

class InboxListTVCell: UITableViewCell {

    @IBOutlet var heightConstrainARView: NSLayoutConstraint!
    @IBOutlet var heightConstrainBottomView: NSLayoutConstraint!
    @IBOutlet weak var viewAR: UIView!
    @IBOutlet weak var viewBottom: UIView!
    
    @IBOutlet weak var lblSlNo: UILabel!
    @IBOutlet weak var lblChaletName: UILabel!
    @IBOutlet weak var lblRent: UILabel!
    @IBOutlet weak var lblCheckOutDate: UILabel!
    @IBOutlet weak var lblCheckInDate: UILabel!
    @IBOutlet weak var lblCheckOutTime: UILabel!
    @IBOutlet weak var lblCheckInTime: UILabel!
    @IBOutlet weak var lblId: UILabel!
    @IBOutlet weak var lblStatus: UILabel!
    @IBOutlet weak var imgChaletImage: UIImageView!
    
    
    @IBOutlet weak var lblARSlNo: UILabel!
    @IBOutlet weak var lblARChaletName: UILabel!
    @IBOutlet weak var lblARRent: UILabel!
    @IBOutlet weak var lblARCheckOutDate: UILabel!
    @IBOutlet weak var lblARCheckInDate: UILabel!
    @IBOutlet weak var lblARCheckOutTime: UILabel!
    @IBOutlet weak var lblARCheckInTime: UILabel!
    @IBOutlet weak var lblARId: UILabel!
    @IBOutlet weak var lblARRentalPrice: UILabel!
    @IBOutlet weak var lblARCommission: UILabel!
    @IBOutlet weak var lblARTotalPaid: UILabel!
    @IBOutlet weak var imgARChaletImage: UIImageView!
    @IBOutlet weak var btnARAccept: UIButton!
    @IBOutlet weak var btnARReject: UIButton!
    
    
    override func awakeFromNib() {
        super.awakeFromNib()
    }

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

        
    }
    
    func setValuesToFields(dict:Reservation_list,isClickedOpen:Bool,index:Int,selectedIdx:Int)  {
        
        self.lblId.text = "\(dict.ownerChalet_details?.first?.chalet_id! ?? 0)"
        self.lblChaletName.text = dict.ownerChalet_details?.first?.chalet_name!
        self.lblRent.text = dict.total_paid!
        self.lblCheckOutDate.text = dict.check_out!
        self.lblCheckOutTime.text = dict.checkout_time!
        self.lblCheckInDate.text = dict.check_in!
        self.lblCheckInTime.text = dict.checkin_time!
        self.lblId.text = dict.reservation_id!
        self.lblStatus.text = dict.booking_status!
        self.imgChaletImage.sd_setImage(with: URL(string: (dict.ownerChalet_details?.first?.cover_photo!)!), placeholderImage: kPlaceHolderImage, options: .highPriority, completed: nil)
        if dict.booking_status == "Reject"{
            self.lblStatus.backgroundColor = UIColor("#FC2447")
        }else if dict.booking_status == "Processing"{
            self.lblStatus.backgroundColor = UIColor("#FF9100")
        }else{
            self.lblStatus.backgroundColor = UIColor("#6FDA44")
        }
        
        self.lblARId.text = "\(dict.ownerChalet_details?.first?.chalet_id! ?? 0)"
        self.lblARChaletName.text = dict.ownerChalet_details?.first?.chalet_name!
        self.lblARRent.text = dict.total_paid!
        self.lblARCheckOutDate.text = dict.check_out!
        self.lblARCheckOutTime.text = dict.checkout_time!
        self.lblARCheckInDate.text = dict.check_in!
        self.lblARCheckInTime.text = dict.checkin_time!
        self.lblARId.text = dict.reservation_id!
        self.imgARChaletImage.sd_setImage(with: URL(string: (dict.ownerChalet_details?.first?.cover_photo!)!), placeholderImage: kPlaceHolderImage, options: .highPriority, completed: nil)
        self.lblARTotalPaid.text = dict.total_paid!
        self.btnARAccept.tag = index
        self.btnARReject.tag = index
        
        let attrsWhatKindOfJob1 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Regular", size: 16)!, NSAttributedString.Key.foregroundColor : #colorLiteral(red: 0.1176470588, green: 0.262745098, blue: 0.3333333333, alpha: 1)] as [NSAttributedString.Key : Any]
        let attrsWhatKindOfJob2 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Medium", size: 16)!, NSAttributedString.Key.foregroundColor : #colorLiteral(red: 0.1176470588, green: 0.262745098, blue: 0.3333333333, alpha: 1)] as [NSAttributedString.Key : Any]
        let attrsWhatKindOfJob5 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Medium", size: 16)!, NSAttributedString.Key.foregroundColor : #colorLiteral(red: 1, green: 0.1491314173, blue: 0, alpha: 1)] as [NSAttributedString.Key : Any]
        
        let attributedRentalPrce1 = NSMutableAttributedString(string:"KD ", attributes:attrsWhatKindOfJob1)
        let attributedRentalPrce2 = NSMutableAttributedString(string:"1000", attributes:attrsWhatKindOfJob2)
        attributedRentalPrce1.append(attributedRentalPrce2)
        self.lblARRentalPrice.attributedText = attributedRentalPrce1
        
        let attributedCommission1 = NSMutableAttributedString(string:"KD - ", attributes:attrsWhatKindOfJob1)
        let attributedCommission2 = NSMutableAttributedString(string:"100 ", attributes:attrsWhatKindOfJob5)
        let attributedCommission3 = NSMutableAttributedString(string:"(10%)", attributes:attrsWhatKindOfJob1)
        attributedCommission1.append(attributedCommission2)
        attributedCommission1.append(attributedCommission3)
        self.lblARCommission.attributedText = attributedCommission1
        
        
        
        if isClickedOpen == false {
            UIView.animate(withDuration: 0.2, animations: { () -> Void in
                self.heightConstrainARView.constant = 0.0
                self.heightConstrainBottomView.constant = 155.0
                self.viewAR.isHidden = true
                self.viewBottom.isHidden = false
                self.layoutIfNeeded()
            })
        }else{
            if index == selectedIdx {
                
                
                UIView.animate(withDuration: 0.2, animations: { () -> Void in
                    self.heightConstrainARView.constant = 355.0
                    self.heightConstrainBottomView.constant = 0.0
                    self.viewAR.isHidden = false
                    self.viewBottom.isHidden = true
                    self.layoutIfNeeded()
                })
                
                
            }else{
                self.heightConstrainARView.constant = 0.0
                self.heightConstrainBottomView.constant = 155.0
                self.viewAR.isHidden = true
                self.viewBottom.isHidden = false
            }
        }
        
    }

}
class InboxAcceptRejectTVCell: UITableViewCell {

    @IBOutlet weak var lblSlNo: UILabel!
    @IBOutlet weak var lblChaletName: UILabel!
    @IBOutlet weak var lblRent: UILabel!
    @IBOutlet weak var lblCheckOutDate: UILabel!
    @IBOutlet weak var lblCheckInDate: UILabel!
    @IBOutlet weak var lblCheckOutTime: UILabel!
    @IBOutlet weak var lblCheckInTime: UILabel!
    @IBOutlet weak var lblId: UILabel!
    @IBOutlet weak var lblRentalPrice: UILabel!
    @IBOutlet weak var lblCommission: UILabel!
    @IBOutlet weak var lblTotalPaid: UILabel!
    @IBOutlet weak var imgChaletImage: UIImageView!
    @IBOutlet weak var btnAccept: UIButton!
    @IBOutlet weak var btnReject: UIButton!

    
    
    override func awakeFromNib() {
        super.awakeFromNib()
        self.setValuesToFields()
    }

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

        
    }
    
    func setValuesToFields() {
        
        let attrsWhatKindOfJob1 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Regular", size: 16)!, NSAttributedString.Key.foregroundColor : #colorLiteral(red: 0.1176470588, green: 0.262745098, blue: 0.3333333333, alpha: 1)] as [NSAttributedString.Key : Any]
        let attrsWhatKindOfJob2 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Medium", size: 16)!, NSAttributedString.Key.foregroundColor : #colorLiteral(red: 0.1176470588, green: 0.262745098, blue: 0.3333333333, alpha: 1)] as [NSAttributedString.Key : Any]
        let attrsWhatKindOfJob5 = [NSAttributedString.Key.font : UIFont(name: "Roboto-Medium", size: 16)!, NSAttributedString.Key.foregroundColor : #colorLiteral(red: 1, green: 0.1491314173, blue: 0, alpha: 1)] as [NSAttributedString.Key : Any]
        
        let attributedRentalPrce1 = NSMutableAttributedString(string:"KD ", attributes:attrsWhatKindOfJob1)
        let attributedRentalPrce2 = NSMutableAttributedString(string:"1000", attributes:attrsWhatKindOfJob2)
        attributedRentalPrce1.append(attributedRentalPrce2)
        self.lblRentalPrice.attributedText = attributedRentalPrce1
        
        let attributedCommission1 = NSMutableAttributedString(string:"KD - ", attributes:attrsWhatKindOfJob1)
        let attributedCommission2 = NSMutableAttributedString(string:"100 ", attributes:attrsWhatKindOfJob5)
        let attributedCommission3 = NSMutableAttributedString(string:"(10%)", attributes:attrsWhatKindOfJob1)
        attributedCommission1.append(attributedCommission2)
        attributedCommission1.append(attributedCommission3)
        self.lblCommission.attributedText = attributedCommission1
        
    }
}
class NoNotificationTVCell: UITableViewCell {
    
}

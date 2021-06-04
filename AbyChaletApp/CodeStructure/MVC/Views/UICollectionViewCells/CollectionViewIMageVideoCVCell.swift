//
//  CollectionViewIMageVideoCVCell.swift
//  AbyChaletApp
//
//  Created by Visakh Srishti on 15/05/21.
//

import UIKit
import SDWebImage
import MediaPlayer
import AVKit


class CollectionViewIMageVideoCVCell: UICollectionViewCell {
    
    @IBOutlet weak var imgChaletImage: UIImageView!
    
}

class CollectionViewVideoCVCell: UICollectionViewCell {
    
    @IBOutlet weak var imgChaletImage: UIImageView!
    
    var playerLayer                     = AVPlayerLayer()
    let playerController                = AVPlayerViewController()

    
    func playVideo(videourl:String,previewImage: String) {
        let player = AVPlayer(url: URL(string: videourl.addingPercentEncoding(withAllowedCharacters: .urlFragmentAllowed)!)!)
        //let player = AVPlayer(url: URL(fileURLWithPath: path))
        playerController.player = player
        self.addSubview(playerController.view)
        playerController.view.frame = CGRect(x: 0, y: 0, width: kScreenWidth - 30, height: 315)
        playerController.view.tintColor = kAppThemeColor
        playerController.player?.play()
        playerController.showsPlaybackControls = false
    }
    
    
}
class CollectionViewChaletDetailsCVCell: UICollectionViewCell {
    
    @IBOutlet weak var lblChaletDetails: UILabel!
    @IBOutlet weak var btnIcon: UIButton!
    
    func setValuesToFields(dict:Chalet_details) {
        self.lblChaletDetails.text = dict.chalet_details!
    }
    
}
class CollectionViewAgreementCVCell: UICollectionViewCell {
    
    @IBOutlet weak var btnAgreement: UIButton!
    @IBOutlet weak var lblAgreement: UILabel!
    
    
    
}
class CollectionViewHolidaysListCVCell : UICollectionViewCell{
    
    
    @IBOutlet weak var lblEventName: UILabel!
    @IBOutlet weak var lblCheckInCheckOutDate: UILabel!
    
}
class CollectionViewChaletListCVCell: UICollectionViewCell {
    
    @IBOutlet weak var viewBg: UIView!
    @IBOutlet weak var lblSlNo: UILabel!
    @IBOutlet weak var lblChaletName: UILabel!
    @IBOutlet weak var lblRent: UILabel!
    @IBOutlet weak var lblCheckOutDate: UILabel!
    @IBOutlet weak var lblCheckInDate: UILabel!
    @IBOutlet weak var lblCheckOutTime: UILabel!
    @IBOutlet weak var lblCheckInTime: UILabel!
    @IBOutlet weak var imgChaletImage: UIImageView!
    
    
    func setValuesToFields(dict : User_details) {
        
        lblSlNo.text = "\(dict.chalet_id ?? 0)"
        lblChaletName.text = dict.chalet_name
        lblRent.text = dict.rent
        lblCheckOutDate.text = dict.check_out
        lblCheckInDate.text = dict.check_in
        lblCheckInTime.text = dict.admincheck_in
        lblCheckOutTime.text = dict.admincheck_out
        if dict.cover_photo != ""{
            imgChaletImage.sd_setImage(with: URL(string: dict.cover_photo!), placeholderImage: kPlaceHolderImage, options: .highPriority, context: nil)
        }else{
            imgChaletImage.image = kPlaceHolderImage
        }
        
        
        
    }
    
    
    
}

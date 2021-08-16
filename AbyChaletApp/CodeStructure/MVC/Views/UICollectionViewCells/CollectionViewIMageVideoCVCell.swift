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

class CollectionViewVideoCVCell: UICollectionViewCell, AVPlayerViewControllerDelegate {
    
    @IBOutlet weak var imgChaletImage: UIImageView!
    @IBOutlet weak var btnPlay: UIButton!

    var playerLayer                     = AVPlayerLayer()
    let playerController                = AVPlayerViewController()

    
    func playVideo(videourl:String,previewImage: String) {
        
        
        DispatchQueue.main.async {
            let img = self.createVideoThumbnail(from: URL(string: videourl.addingPercentEncoding(withAllowedCharacters: .urlFragmentAllowed)!)!)
            if img != nil {
                self.imgChaletImage.image = img
            }else{
                self.imgChaletImage.image = kPlaceHolderImage
            }
        }
        
        
        /*let player = AVPlayer(url: URL(string: videourl.addingPercentEncoding(withAllowedCharacters: .urlFragmentAllowed)!)!)
        //let player = AVPlayer(url: URL(fileURLWithPath: path))
        playerController.player = player
        //self.addSubview(playerController.view)
        playerController.view.frame = CGRect(x: 0, y: 0, width: kScreenWidth - 30, height: 315)
        playerController.view.tintColor = kAppThemeColor
        //playerController.player?.play()
        


        playerController.showsPlaybackControls = true
        NotificationCenter.default.addObserver(self, selector: #selector(stopVideoPlayer), name: NSNotification.Name(rawValue: NotificationNames.kStopVideoPlayer), object: nil)*/
        
        
    }
    @objc func stopVideoPlayer() {
        playerController.player?.pause()
    }
    
    private func createVideoThumbnail(from url: URL) -> UIImage? {
        let asset = AVAsset(url: url)
        let assetImgGenerate = AVAssetImageGenerator(asset: asset)
        assetImgGenerate.appliesPreferredTrackTransform = true
        assetImgGenerate.maximumSize = CGSize(width: frame.width, height: frame.height)
        let time = CMTimeMakeWithSeconds(0.0, preferredTimescale: 600)
        do {
            let img = try assetImgGenerate.copyCGImage(at: time, actualTime: nil)
            let thumbnail = UIImage(cgImage: img)
            return thumbnail
        }
        catch {
          print(error.localizedDescription)
          return nil
        }
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
class CollectionViewHolidaysListCVCell : UICollectionViewCell, UICollectionViewDelegate, UICollectionViewDataSource{
    var idx = 0
    var day = ""
    var datesArray = [String]()
    @IBOutlet weak var viewCalendar: UIView!
    @IBOutlet weak var lblEventName: UILabel!
    @IBOutlet weak var lblEventNameNew: UILabel!
    @IBOutlet weak var lblCheckInDate: UILabel!
    @IBOutlet weak var lblCheckInCheckOutDate: UILabel!
    @IBOutlet weak var collectionViewHoliday: UICollectionView!
    
    @IBOutlet weak var lblCheckInDateNew: UILabel!
    @IBOutlet weak var lblCheckOutDateNew: UILabel!
    @IBOutlet weak var lblCheckInTimeNew: UILabel!
    @IBOutlet weak var lblCheckOutTimeNew: UILabel!
    
    //MARK:- SetupCalanderUI
    lazy var  calenderView: CalenderViewNew = {
        let calenderView = CalenderViewNew.init(theme: MyThemeNew.light, isSelectionEnabled: true)
        calenderView.translatesAutoresizingMaskIntoConstraints=false
        
        return calenderView
    }()
    
    func setupCalenderView() {
        
        viewCalendar.layer.masksToBounds = true
        viewCalendar.layer.cornerRadius = 0.0
        viewCalendar.layer.borderWidth = 0.5
        viewCalendar.layer.borderColor = UIColor.clear.cgColor
        
        viewCalendar.addSubview(calenderView)
        //calenderView.delegate = self
        calenderView.topAnchor.constraint(equalTo: viewCalendar.topAnchor, constant: 0).isActive=true
        calenderView.rightAnchor.constraint(equalTo: viewCalendar.rightAnchor, constant: 0).isActive=true
        calenderView.leftAnchor.constraint(equalTo: viewCalendar.leftAnchor, constant: 0).isActive=true
        calenderView.heightAnchor.constraint(equalToConstant: 425).isActive=true
        
        //calenderView.bookedSlotDate = [10, 12, 15, 18, 20]
        calenderView.myCollectionView.reloadData()
        
    }
    
    func loadView(dictChalet : Chalet_list) {
        
        let width = kScreenWidth - 37
        let columnLayout = ColumnFlowLayout.init(cellsPerRow: 7, minimumInteritemSpacing: 0.0, minimumLineSpacing: 0.0, sectionInset: UIEdgeInsets(top: 0, left: 0, bottom: 0, right: 0), cellHeight: 38, cellWidth: width / 7,scrollDirec: .vertical)
        collectionViewHoliday?.collectionViewLayout = columnLayout
        
        let startDate = dictChalet.check_in
        let dateformatter = DateFormatter()
        dateformatter.dateFormat = "yyyy-MM-dd"
        let dayDate = dateformatter.date(from: startDate!)
        let dayy = dayDate?.dayOfTheWeek()
        day = dayy!
        if day == "Sunday" {
            idx = 0
        }else if day == "Monday" {
            idx = 1
        }else if day == "Tuesday" {
            idx = 2
        }else if day == "Wednesday" {
            idx = 3
        }else if day == "Thursday" {
            idx = 4
        }else if day == "Friday" {
            idx = 5
        }else if day == "Saturday" {
            idx = 6
        }
        datesArray = betWeenDates(fromDate: dictChalet.check_in!, toDate: dictChalet.check_out!)
        collectionViewHoliday.dataSource = self
    }
    
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        return 14
    }
    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "CollectionViewHolidaysEventsCVCell", for: indexPath) as! CollectionViewHolidaysEventsCVCell
        
        if indexPath.row >= idx {
            if indexPath.row >= datesArray.count + idx {
                cell.bgView.backgroundColor = .white
                cell.lbl.text = ""
            }else{
                cell.bgView.backgroundColor = UIColor("#EBEBEB")
                let dateformatter = DateFormatter()
                dateformatter.dateFormat = "yyyy-MM-dd"
                let date = dateformatter.date(from: datesArray[indexPath.row - idx])
                dateformatter.dateFormat = "dd"
                cell.lbl.text = dateformatter.string(from: date!)
            }
           
        }else{
            cell.bgView.backgroundColor = .white
        }
        return cell
    }
    
    func betWeenDates(fromDate:String,toDate:String) -> [String] {
        var mydates : [String] = []
        let startDate = fromDate
        let endDate   = toDate
        var dateFrom =  Date()
        var dateTo = Date()
        let fmt = DateFormatter()
        fmt.dateFormat = "yyyy-MM-dd"
        dateFrom = fmt.date(from: startDate)!
        dateTo = fmt.date(from: endDate)!
        while dateFrom <= dateTo {
            mydates.append(fmt.string(from: dateFrom))
            dateFrom = Calendar.current.date(byAdding: .day, value: 1, to: dateFrom)!
        }
        return mydates
    }
    
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
        
        lblSlNo.text = "No. \(dict.chalet_id ?? 0)"
        lblChaletName.text = dict.chalet_name
        lblRent.text = dict.rent
        lblCheckOutDate.text = dict.check_out?.appFormattedDate
        lblCheckInDate.text = dict.check_in?.appFormattedDate
        lblCheckInTime.text = dict.admincheck_in
        lblCheckOutTime.text = dict.admincheck_out
        if dict.cover_photo != ""{
            imgChaletImage.sd_setImage(with: URL(string: dict.cover_photo!), placeholderImage: kPlaceHolderImage, options: .highPriority, context: nil)
        }else{
            imgChaletImage.image = kPlaceHolderImage
        }
        
        
        
    }
    
    
    
}
class CollectionViewHolidaysEventsCVCell: UICollectionViewCell {
    
    @IBOutlet weak var bgView: UIView!
    @IBOutlet weak var lbl : UILabel!
    
}

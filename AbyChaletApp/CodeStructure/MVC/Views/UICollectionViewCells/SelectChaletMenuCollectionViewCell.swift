//
//  SelectChaletMenuCollectionViewCell.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 28/04/21.
//

import UIKit
import SDWebImage

class SelectChaletMenuCollectionViewCell: UICollectionViewCell {
    
    @IBOutlet weak var lblTitle: UILabel!
    @IBOutlet weak var imgViewBg: UIImageView!
    override var isSelected: Bool {
        didSet {
                isSelected ? setGradientColorForPackageSelectedCell(view: self) : setGradientColorForPackageUnselectedCell(view: self)
                }
        }
    
    override func awakeFromNib() {
    }
}


class ContactUsCollectionViewCell: UICollectionViewCell {
    
    @IBOutlet weak var lblName: UILabel!
    @IBOutlet weak var imgViewProfle: UIImageView!
    @IBOutlet weak var btnWhatsApp: UIButton!
    
    override func awakeFromNib() {
    }
    
    func setValuesToFieldes(dictContact:Contact_list) {
        self.lblName.text = dictContact.name!
        if dictContact.profile_pic != ""{
            self.imgViewProfle.sd_setImage(with: URL(string: dictContact.profile_pic!), placeholderImage: #imageLiteral(resourceName: "maleplaceholder"), options: .highPriority, completed: nil)
            
        }else{
            self.imgViewProfle.image = #imageLiteral(resourceName: "maleplaceholder")
        }
        
    }
}

//
//  CountryCodeListTableViewCell.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 11/05/21.
//

import UIKit

class CountryCodeListTableViewCell: UITableViewCell {

    @IBOutlet weak var imgViewForCountryFlag: UIImageView!
    @IBOutlet weak var lblCountryName: UILabel!
    @IBOutlet weak var lblCountryCode: UILabel!
    
    var countryListDetails: CountryDetailsDataStruct! {
        didSet {
            imgViewForCountryFlag.image = UIImage(named: countryListDetails.countryFlag)
            lblCountryName.text = countryListDetails.countryName
            lblCountryCode.text = countryListDetails.countryCode
        }
    }
    
    
    override func awakeFromNib() {
        super.awakeFromNib()
        // Initialization code
    }

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

        // Configure the view for the selected state
    }

}

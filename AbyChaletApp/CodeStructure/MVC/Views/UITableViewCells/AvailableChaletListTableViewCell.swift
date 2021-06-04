//
//  AvailableChaletListTableViewCell.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 30/04/21.
//

import UIKit

class AvailableChaletListTableViewCell: UITableViewCell {

    @IBOutlet weak var lblChaletNumber: UILabel!
    @IBOutlet weak var lblChaletName: UILabel!
    @IBOutlet weak var imgViewForChalet: UIImageView!
    @IBOutlet weak var lblRupees: UILabel!
    @IBOutlet weak var lblRupeesType: UILabel!
    @IBOutlet weak var lblCheckOutData: UILabel!
    @IBOutlet weak var lblCheckOutTime: UILabel!
    @IBOutlet weak var lblCheckInDate: UILabel!
    @IBOutlet weak var lblCheckInTime: UILabel!
    
    override func awakeFromNib() {
        super.awakeFromNib()
        // Initialization code
    }

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

        // Configure the view for the selected state
    }

}

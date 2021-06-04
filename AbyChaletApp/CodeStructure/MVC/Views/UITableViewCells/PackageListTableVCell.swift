//
//  PackageListTableVC.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 28/04/21.
//

import UIKit

class PackageListTableVCell: UITableViewCell {

    @IBOutlet weak var lblPackageDays: UILabel!
    @IBOutlet weak var lblPackageType: UILabel!
    
    var packageListData: PackageBookingChartStruct! {
        didSet {
            lblPackageType.text = packageListData.type
            lblPackageDays.text = packageListData.days
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

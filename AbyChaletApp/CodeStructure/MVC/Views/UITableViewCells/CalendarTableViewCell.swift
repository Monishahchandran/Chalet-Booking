//
//  CalendarTableViewCell.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 30/04/21.
//

import UIKit

class CalendarTableViewCell: UITableViewCell {

    @IBOutlet weak var viewForCalenderContaintView: UIView!
    @IBOutlet weak var viewForCalendar: UIView!
    @IBOutlet weak var viewForReservedInfo: UIView!
    @IBOutlet weak var lblRedclrReservedTitle: UILabel!
    
    fileprivate let gregorian = Calendar(identifier: .gregorian)
    fileprivate let formatter: DateFormatter = {
        let formatter = DateFormatter()
        formatter.dateFormat = "yyyy-MM-dd"
        return formatter
    }()
    
    override func awakeFromNib() {
        super.awakeFromNib()
        //Arial Bold 22.0
        lblRedclrReservedTitle.text = "Red color is (reserved)".localized()
        if kCurrentLanguageCode == "ar"{
            lblRedclrReservedTitle?.font = UIFont(name: kFontAlmaraiBold, size: 22)!
            
        }else{
            lblRedclrReservedTitle?.font = UIFont(name: "Arial-BoldMT", size: 22)!
        }
    }
    
    

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

        // Configure the view for the selected state
    }

}



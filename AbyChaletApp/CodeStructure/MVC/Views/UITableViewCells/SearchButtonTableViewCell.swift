//
//  SearchButtonTableViewCell.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 30/04/21.
//

import UIKit

class SearchButtonTableViewCell: UITableViewCell {
    @IBOutlet weak var btnSearch: UIButton!
    
    override func awakeFromNib() {
        super.awakeFromNib()
        btnSearch.addCorner()
        btnSearch.titleLabel?.text = "Search".localized()
        btnSearch.addBorder()
    }

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

    }
    
    @IBAction func btnSearchDidTap(_ sender: Any) {
    }
}

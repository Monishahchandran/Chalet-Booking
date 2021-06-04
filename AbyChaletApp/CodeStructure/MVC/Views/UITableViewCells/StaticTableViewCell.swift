//
//  StaticTableViewCell.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 14/05/21.
//

import UIKit

class StaticTableViewCell: UITableViewCell {

 
    lazy var keyboardHideButton: UIButton = {
        let button = UIButton()
        button.frame = self.contentView.bounds
        button.addTarget(self, action: #selector(self.hideKeyboard), for: .touchUpInside)
        return button
    }()
    
    override func awakeFromNib() {
        super.awakeFromNib()
        delay(seconds: 0.2) {
            self.contentView.insertSubview(self.keyboardHideButton, at: 0)
        }
    }
    
    @objc func hideKeyboard(){
        self.endEditing(true)
        self.superview?.endEditing(true)
        self.superview?.superview?.endEditing(true)
        self.superview?.superview?.superview?.endEditing(true)
        self.superview?.superview?.superview?.superview?.endEditing(true)
        self.superview?.superview?.superview?.superview?.superview?.endEditing(true)
        self.superview?.superview?.superview?.superview?.superview?.superview?.endEditing(true)
        self.superview?.superview?.superview?.superview?.superview?.superview?.superview?.endEditing(true)
    }
    
    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)
        
        // Configure the view for the selected state
    }

}

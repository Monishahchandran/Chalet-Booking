//
//  SignUpButtonTableViewCell.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 04/05/21.
//

import UIKit

class SignUpButtonTableViewCell: UITableViewCell {

    @IBOutlet weak var btnSignUp: UIButton!
    override func awakeFromNib() {
        super.awakeFromNib()
        btnSignUp.addCorner()
        btnSignUp.addBorder()
        btnSignUp.setTitle("SIGN UP".localized(), for: .normal)
    }

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

        // Configure the view for the selected state
    }

}

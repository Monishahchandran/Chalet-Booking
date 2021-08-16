//
//  SignUpProfileDetailsTableViewCell2.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 04/05/21.
//

import UIKit
import SkyFloatingLabelTextField
class SignUpProfileDetailsTableViewCell2: UITableViewCell {
    @IBOutlet weak var imgViewEmailAdd: UIImageView!
    @IBOutlet weak var imgViewForPhoneCall: UIImageView!
    @IBOutlet weak var imgViewForPassword: UIImageView!
    @IBOutlet weak var imgViewForConfirmPasswrd: UIImageView!
    
    @IBOutlet weak var txtEmailAdd: SkyFloatingLabelTextField!
    @IBOutlet weak var txtPassword: SkyFloatingLabelTextField!
    @IBOutlet weak var txtConfirmPasswrd: SkyFloatingLabelTextField!
    @IBOutlet weak var txtForCountryCode: SkyFloatingLabelTextField!

    @IBOutlet weak var txtforMobileNumber: SkyFloatingLabelTextField!
    
    @IBOutlet weak var imgViewForCountryCode: UIImageView!
    var country = ""
    override func awakeFromNib() {
        super.awakeFromNib()
        txtEmailAdd.keyboardType = .emailAddress
        txtEmailAdd.autocorrectionType = .no
        txtEmailAdd.autocapitalizationType = .none
        txtPassword.isSecureTextEntry = true
        txtConfirmPasswrd.isSecureTextEntry = true
        [txtEmailAdd, txtPassword, txtConfirmPasswrd,txtforMobileNumber, txtForCountryCode].forEach { (skyFloatingTextField) in
            skyFloatingTextField?.lineView.isHidden = true
            if kCurrentLanguageCode == "ar"{
                skyFloatingTextField?.titleFont = UIFont(name: kFontAlmaraiRegular, size: 15)!
                skyFloatingTextField?.placeholderFont = UIFont(name: kFontAlmaraiRegular, size: 15)!
                skyFloatingTextField?.font = UIFont(name: kFontAlmaraiRegular, size: 15)!
                skyFloatingTextField?.textAlignment = .right
            }else{
                skyFloatingTextField?.titleFont = UIFont(name: "Roboto-Medium", size: 15)!
                skyFloatingTextField?.placeholderFont = UIFont(name: "Roboto-Medium", size: 15)!
                skyFloatingTextField?.font = UIFont(name: "Roboto-Medium", size: 15)!
                skyFloatingTextField?.textAlignment = .left
            }
            skyFloatingTextField?.titleFormatter = { (text: String) -> String in
                return text
            }
        }
        txtForCountryCode.setLeftPaddingPoints(20)
        txtEmailAdd.placeholder = "Email Address".localized()
        txtPassword.placeholder = "Password".localized()
        txtConfirmPasswrd.placeholder = "Confirm Password".localized()
        txtForCountryCode.placeholder = "Country Code".localized()
        txtforMobileNumber.placeholder = "Mobile Number".localized()
        txtEmailAdd.selectedTitle = "Email Address".localized()
        txtPassword.selectedTitle = "Password".localized()
        txtConfirmPasswrd.selectedTitle = "Confirm Password".localized()
        txtForCountryCode.selectedTitle = "Country Code".localized()
        txtforMobileNumber.selectedTitle = "Mobile Number".localized()
        
        
    }

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

        // Configure the view for the selected state
    }

}

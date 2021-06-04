//
//  SignUpProfileDetailsTableViewCell1.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 04/05/21.
//

import UIKit
import SkyFloatingLabelTextField
class SignUpProfileDetailsTableViewCell1: UITableViewCell  {

    @IBOutlet weak var imgViewForProfilePicture: UIImageView!
    @IBOutlet weak var imgViewForProfileIcon: UIImageView!
    @IBOutlet weak var txtFirstName: SkyFloatingLabelTextField!
    
    @IBOutlet weak var txtLastName: SkyFloatingLabelTextField!
    @IBOutlet weak var imgViewForDateOfBirth: UIImageView!
    @IBOutlet weak var txtDateOfBirth: SkyFloatingLabelTextField!
    @IBOutlet weak var btnFemale: UIButton!
    @IBOutlet weak var viewForFemaleButton: UIView!
    @IBOutlet weak var viewForButtonSelectedGreenView: UIView!
    @IBOutlet weak var viewForMaleButton: UIView!
    @IBOutlet weak var viewForMalebuttonSelectedGreenview: UIView!
    @IBOutlet weak var btnMale: UIButton!
 
    @IBOutlet weak var txtBirthMonth: UITextField!
    @IBOutlet weak var txtBirthDay: UITextField!
    @IBOutlet weak var txtBirthYear: UITextField!
    
    override func awakeFromNib() {
        super.awakeFromNib()

        txtFirstName.autocorrectionType = .no
        txtFirstName.autocapitalizationType = .words
        txtLastName.autocorrectionType = .no
        txtLastName.autocapitalizationType = .words
        [txtFirstName,txtLastName,txtDateOfBirth].forEach { (skyFloatingTextField) in
            skyFloatingTextField?.lineView.isHidden = true
            skyFloatingTextField?.titleFont = UIFont(name: "Roboto-Medium", size: 15)!
            skyFloatingTextField?.placeholderFont = UIFont(name: "Roboto-Medium", size: 15)!
            skyFloatingTextField?.font = UIFont(name: "Roboto-Medium", size: 15)!
            skyFloatingTextField?.titleFormatter = { (text: String) -> String in
                return text
            }
        }
        txtBirthDay.keyboardType = .numberPad
        txtBirthMonth.keyboardType = .numberPad
        txtBirthYear.keyboardType = .numberPad
        txtFirstName.placeholder = "First Name".localized()
        txtLastName.placeholder = "Last Name".localized()
        txtDateOfBirth.placeholder = "Date of Birth".localized()
        txtDateOfBirth.selectedTitle = "Date of Birth".localized()
        txtBirthDay.placeholder = "Day".localized()
        txtBirthMonth.placeholder = "Month".localized()
        txtBirthYear.placeholder = "Year".localized()
        btnMale.setTitle("Male".localized(), for: .normal)
        btnFemale.setTitle("Female".localized(), for: .normal)
        txtFirstName.selectedTitle = "First Name".localized()
        txtLastName.selectedTitle = "Last Name".localized()
        txtDateOfBirth.text = "k"

    }
    override func layoutSubviews() {
        super.layoutSubviews()

        viewForFemaleButton.addCornerForView()
        viewForFemaleButton.addShadowForView()
        viewForMaleButton.addCornerForView()
        viewForMaleButton.addShadowForView()
        viewForButtonSelectedGreenView.addCornerForView()
        viewForMalebuttonSelectedGreenview.addCornerForView()
    }
    
}

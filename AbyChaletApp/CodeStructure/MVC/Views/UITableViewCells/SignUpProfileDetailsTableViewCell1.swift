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
    
    
    var datePicker =  UIDatePicker()
    
    override func awakeFromNib() {
        super.awakeFromNib()

        txtFirstName.autocorrectionType = .no
        txtFirstName.autocapitalizationType = .words
        txtLastName.autocorrectionType = .no
        txtLastName.autocapitalizationType = .words
        [txtFirstName,txtLastName,txtDateOfBirth].forEach { (skyFloatingTextField) in
            skyFloatingTextField?.lineView.isHidden = true
            if kCurrentLanguageCode == "ar"{
                skyFloatingTextField?.titleFont = UIFont(name: kFontAlmaraiRegular, size: 15)!
                skyFloatingTextField?.placeholderFont = UIFont(name: kFontAlmaraiRegular, size: 15)!
                skyFloatingTextField?.font = UIFont(name: kFontAlmaraiRegular, size: 15)!
                skyFloatingTextField?.textAlignment = .right
                skyFloatingTextField?.isLTRLanguage = true
                
            }else{
                skyFloatingTextField?.titleFont = UIFont(name: "Roboto-Medium", size: 15)!
                skyFloatingTextField?.placeholderFont = UIFont(name: "Roboto-Medium", size: 15)!
                skyFloatingTextField?.font = UIFont(name: "Roboto-Medium", size: 15)!
                skyFloatingTextField?.textAlignment = .left
                skyFloatingTextField?.isLTRLanguage = true
            }
            skyFloatingTextField?.titleFormatter = { (text: String) -> String in
                
                return text
            }
        }
        txtBirthDay.keyboardType = .numberPad
        txtBirthMonth.keyboardType = .numberPad
        txtBirthYear.keyboardType = .numberPad
        txtFirstName.placeholder = "First Name".localized()
        txtLastName.placeholder = "Last Name".localized()
        if kCurrentLanguageCode == "ar"{
            txtDateOfBirth.textAlignment = .right
        }else{
            txtDateOfBirth.textAlignment = .left
        }
        txtDateOfBirth.placeholder = "Date Of Birth".localized()
        txtDateOfBirth.selectedTitle = "Date Of Birth".localized()
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
    
    
    @IBAction func txtYearAction(_ sender: UITextField) {
        
        
    }
    
    @objc func donedatePicker(){
        
    }
    @objc func cancelDatePicker(){
        
    }
    
}

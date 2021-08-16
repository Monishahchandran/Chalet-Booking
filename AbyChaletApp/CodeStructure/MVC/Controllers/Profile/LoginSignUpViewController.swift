//
//  LoginSignUpViewController.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 03/05/21.
//

import UIKit
import SkyFloatingLabelTextField
class LoginSignUpViewController: UIViewController , UINavigationControllerDelegate, UIImagePickerControllerDelegate{
    
    @IBOutlet weak var viewForSignUpBottomLine: UIView!
    @IBOutlet weak var btnsignUpTopMenu: UIButton!
    @IBOutlet weak var viewForLoginBottomLine: UIView!
    @IBOutlet weak var btnLoginTopMenu: UIButton!
    @IBOutlet weak var viewForLogin: UIView!
    @IBOutlet weak var txtEmailAddress: SkyFloatingLabelTextField!
    @IBOutlet weak var btnForgotPassword: UIButton!
    @IBOutlet weak var txtPassword: SkyFloatingLabelTextField!
    @IBOutlet weak var btnRememberMe: UIButton!
    @IBOutlet weak var btnLogin: UIButton!
    @IBOutlet weak var tblView: UITableView!
    var countryCodePopUpViewController:CountryCodePopUpViewController!
    var imagePicker = UIImagePickerController()
    var countryCodePopUpDelegate:CountryCodePopUpDelegate?
    
    var firstName: String = "", lastName: String = "", dateOfBirth: String = "", birthDay: String = "",
        birthMonth: String = "", birthYear: String = "", emailAddress: String = "", personGender: String = "", password: String = "", confirmPassword: String = "", contryCode: String = "", mobileNumber: String = "",countryName : String = ""
    var isBtnGenderSelected:Bool = false
    var isRemember:Bool = false
    var timerTest : Timer?
    var totalTime = 600
    var isUserLogin:Bool = false
    var btnRememberSelected:Bool = false
    var isFromNoLogin = Bool()
    var selectedProfileImage : UIImage!
    override func viewDidLoad() {
        super.viewDidLoad()
        txtPassword.isSecureTextEntry = true
        txtEmailAddress.keyboardType = .emailAddress
        txtEmailAddress.autocorrectionType = .no
        txtEmailAddress.autocapitalizationType = .none
        [txtEmailAddress,txtPassword].forEach { (skyFloatingTextField) in
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
        btnLoginTopMenuDidTap(UIButton.self)
        tblView.keyboardDismissMode = .onDrag
        btnsignUpTopMenu.setTitle("SignUp".localized(), for: .normal)
        btnsignUpTopMenu.setTitle("SignUp".localized(), for: .selected)
        btnLoginTopMenu.setTitle("Login".localized(), for: .normal)
        btnLoginTopMenu.setTitle("Login".localized(), for: .selected)
        btnForgotPassword.setTitle("Forgot password?".localized(), for: .normal)
        btnLogin.setTitle("LOGIN".localized(), for: .normal)
        txtEmailAddress.placeholder = "Email Address".localized()
        txtPassword.placeholder = "Password".localized()
        txtEmailAddress.selectedTitle = "Email Address".localized()
        
        txtPassword.selectedTitle = "Password".localized()
        if kCurrentLanguageCode == "ar"{
            btnsignUpTopMenu.titleLabel?.font = UIFont(name: kFontAlmaraiBold, size: 18)
            btnForgotPassword.titleLabel?.font = UIFont(name: kFontAlmaraiRegular, size: 15)
            btnLoginTopMenu.titleLabel?.font = UIFont(name: kFontAlmaraiBold, size: 18)
            btnLogin.titleLabel?.font = UIFont(name: kFontAlmaraiBold, size: 20)
        }else{
            btnsignUpTopMenu.titleLabel?.font = UIFont(name: "Arial Bold", size: 20)
            btnForgotPassword.titleLabel?.font = UIFont(name: "Roboto-Medium", size: 15)
            btnLoginTopMenu.titleLabel?.font = UIFont(name: "Arial Bold", size: 20)
            btnLogin.titleLabel?.font = UIFont(name: kFontRobotoBold, size: 20)
        }
        
        btnLogin.addCorner()
        btnLogin.addBorder()
    }
    
    override func viewWillAppear(_ animated: Bool) {
        super.viewWillAppear(animated)
        self.tabBarController?.tabBar.isHidden = false
        navigationItem.title = ""
        self.navigationController?.navigationBar.isHidden = true
        
        
    }
    
    override func viewDidLayoutSubviews() {
        super.viewDidLayoutSubviews()
        
        
    }
    
    override func viewWillDisappear(_ animated: Bool) {
        super.viewWillDisappear(animated)
        if  countryCodePopUpViewController != nil {
            countryCodePopUpViewController.view.removeFromSuperview()
            countryCodePopUpViewController.removeFromParent()
            countryCodePopUpViewController = nil
        }
    }
}
//MARK:- @IBAction
extension LoginSignUpViewController {
    
    var isSelfFromValidForLogin:(Bool, String?, String?){
        let emailAddForLogin = txtEmailAddress.text ?? ""
        let passwordForLogin = txtPassword.text ?? ""
        if emailAddForLogin.isEmpty && password.isEmpty {
            showDefaultAlert(viewController: self, title: "Message".localized(), msg: "Please enter email address and password".localized())
            return (false , nil , nil)
        }
        else if emailAddForLogin.isEmpty {//&& phoneNumberFromSocialMedia.isEmpty  {
            showDefaultAlert(viewController: self, title: "Message".localized(), msg: "Please enter email address".localized())
            return (false , nil , nil)
        }
        else if !AbyChaletApp.isValidEmail(email: emailAddForLogin){
            showDefaultAlert(viewController: self, title: "Message".localized(), msg: "Please enter valid email address".localized())
            
            return (false, nil, nil)
        }
        else if passwordForLogin.isEmpty {
            showDefaultAlert(viewController: self, title: "Message".localized(), msg: "Please enter password".localized())
            
            return (false, nil , nil)
        }
        return (true, emailAddForLogin, passwordForLogin)
    }
    
    var isSelfFromValidForSignUp:(Bool, String?, String?, String?, String?, String?, String?, String? , String?, String?, String?) {
        // dateOfBirth = "\(birthDay)-)"+"\(birthMonth)-)"+"\(birthYear)"
        dateOfBirth = "\(birthYear)-"+"\(birthMonth)-"+"\(birthDay)"
        if firstName.isEmpty {//&& phoneNumberFromSocialMedia.isEmpty  {
            showDefaultAlert(viewController: self, title: "", msg: "Please enter first name".localized())
            return (false , nil , nil , nil , nil, nil, nil, nil, nil, nil, nil)
        } else if lastName.isEmpty {//&& phoneNumberFromSocialMedia.isEmpty  {
            showDefaultAlert(viewController: self, title: "", msg: "Please enter last name".localized())
            return (false , nil , nil , nil , nil, nil, nil, nil, nil, nil, nil)
        } else if birthDay.isEmpty{ //&& phoneNumberFromSocialMedia.isEmpty  {
            showDefaultAlert(viewController: self, title: "", msg: "Please enter day of birth".localized())
            
            return (false, nil, nil, nil , nil, nil, nil, nil, nil, nil, nil)
        }else if birthMonth.isEmpty{ //&& phoneNumberFromSocialMedia.isEmpty  {
            showDefaultAlert(viewController: self, title: "", msg: "Please enter month of birth".localized())
            
            return (false, nil, nil, nil , nil, nil, nil, nil, nil, nil, nil)
        }else if birthYear.isEmpty{ //&& phoneNumberFromSocialMedia.isEmpty  {
            showDefaultAlert(viewController: self, title: "", msg: "Please enter year of birth".localized())
            return (false, nil, nil, nil , nil, nil, nil, nil, nil, nil, nil)
        }else if dateOfBirth.isEmpty{ //&& phoneNumberFromSocialMedia.isEmpty  {
            showDefaultAlert(viewController: self, title: "", msg: "Please Enter Date Of birth".localized())
            
            return (false, nil, nil, nil , nil, nil, nil, nil, nil, nil, nil)
        } else if personGender.isEmpty {
            showDefaultAlert(viewController: self, title: "", msg: "Please select gender".localized())
            
            return (false, nil, nil, nil , nil, nil, nil, nil, nil, nil, nil)
        }else  if emailAddress.isEmpty {//&& phoneNumberFromSocialMedia.isEmpty  {
            showDefaultAlert(viewController: self, title: "", msg: "Please enter email address".localized())
            return (false, nil, nil, nil , nil, nil, nil, nil, nil, nil, nil)
        }
        else if !AbyChaletApp.isValidEmail(email: emailAddress) && emailAddress.isEmpty {
            showDefaultAlert(viewController: self, title: "", msg: "Please enter valid email address".localized())
            return (false, nil, nil, nil , nil, nil, nil, nil, nil, nil, nil)
        }
        else if password.isEmpty {
            showDefaultAlert(viewController: self, title: "", msg: "Please enter password".localized())
            return (false, nil , nil , nil, nil, nil, nil, nil, nil, nil, nil)
        }
        else if !limitValidation(string: password, minLength: 5, maxLength: 0){
            showDefaultAlert(viewController: self, title: "", msg: "Please enter minimum 5 characters in password".localized())
            return (false, nil , nil , nil , nil, nil, nil, nil, nil, nil, nil)
        }
        else if confirmPassword.isEmpty {
            showDefaultAlert(viewController: self, title: "", msg: "Please enter confirm password".localized())
            return (false, nil , nil , nil , nil, nil, nil, nil, nil, nil, nil)
        }
        
        else if password != confirmPassword {
            showDefaultAlert(viewController: self, title: "", msg: "Passwords do not match".localized())
            return (false, nil , nil , nil , nil, nil, nil, nil, nil, nil, nil)
        }
        else if contryCode.isEmpty{
            showDefaultAlert(viewController: self, title: "", msg: "Please Enter Country Code".localized())
            return (false, nil , nil , nil , nil, nil, nil, nil, nil, nil, nil)
        }
        else if  mobileNumber.isEmpty{
            showDefaultAlert(viewController: self, title: "", msg: "Please Enter Mobile Number".localized())
            
            return (false, nil , nil , nil , nil, nil, nil, nil, nil, nil, nil)
        }
        else if !limitValidation(string: mobileNumber, minLength: 6, maxLength: 14){
            showDefaultAlert(viewController: self, title: "", msg: "Please Enter Minimum 6 and Maximum 14 Characters In Mobile Number".localized())
            
            return (false, nil , nil , nil , nil, nil, nil, nil, nil, nil, nil)
        }
        
        return (true, firstName, lastName, dateOfBirth, personGender, emailAddress, emailAddress, password, confirmPassword, contryCode, mobileNumber )
    }
    
    
    @IBAction func btnLoginTopMenuDidTap(_ sender: Any) {
        self.tblView.isHidden = true
        self.viewForLogin.isHidden = false
        
        self.viewForLoginBottomLine.isHidden = false
        viewForSignUpBottomLine.isHidden = true
        btnLoginTopMenu.isSelected = true
        btnsignUpTopMenu.isSelected = false
    }
    
    @IBAction func btnSignUpTopMenuDidTap(_ sender: Any) {
        self.tblView.isHidden = false
        self.viewForLogin.isHidden = true
        
        self.viewForLoginBottomLine.isHidden = true
        viewForSignUpBottomLine.isHidden = false
        btnLoginTopMenu.isSelected = false
        btnsignUpTopMenu.isSelected = true
        
    }
    
    @IBAction func btnRememberMeDidTap(_ sender: UIButton) {
        btnRememberSelected = !btnRememberSelected
        if btnRememberSelected {
            sender.isSelected = true
            logginOffTimer()
        }else {
            sender.isSelected = false
        }
    }
    
    
    func logginOffTimer(){
        if isUserLogin {
            if btnRememberSelected {
                guard timerTest == nil else { return }
                timerTest = Timer.scheduledTimer(timeInterval: 600, target: self, selector: #selector(loggingOffApplication), userInfo: nil, repeats: false)
            }else {
                timerTest?.invalidate()
                timerTest = nil
            }
        }
    }
    
    @objc private func loggingOffApplication() {
        showCustomAlert(title: "", message: "You have been logged Out, please login again.", isError: false)
        redirectingToHomeScreen(index: 3)
    }
    
    
    @IBAction func btnLoginDidTap(_ sender: Any) {
        let (isValid, emailAdd, password) = self.isSelfFromValidForLogin
        guard isValid else{ return}
        
        self.loginWithDetails(emailID: emailAdd ?? "", password: password ?? "", deviceToken: "")
        
    }
    
    @objc func btnSignUpDidTap(_ sender:UIButton){
        let (isValid, firstName, lastName, dob, gender, emailID, _, password, _, contryCode, mobileNum) = self.isSelfFromValidForSignUp
        guard isValid else{ return}
        
        self.userRegisterWithDetails(frstName: firstName ?? "", lastName: lastName ?? "", emailID: emailID ?? "", password: password ?? "", deviceToken: "", phone: mobileNum ?? "", dob: dob ?? "", gender: gender ?? "", country: contryCode ?? "", countryCode: contryCode ?? "")
        
        
    }
    
    @IBAction func btnForgotPasswordDidTap(_ sender: Any) {
        
        let nextVC = UIStoryboard(name: "Profile", bundle: Bundle.main).instantiateViewController(identifier: "ForgotPasswordViewController") as! ForgotPasswordViewController
        self.navigationController?.pushViewController(nextVC, animated: true)
    }
    
    
    
    @objc func btnFemaleDidTap(_ sender: UIButton) {
        
        let cell:SignUpProfileDetailsTableViewCell1 = tblView.cellForRow(at: IndexPath(row: 0, section: 0)) as! SignUpProfileDetailsTableViewCell1
        isBtnGenderSelected = !isBtnGenderSelected
        if isBtnGenderSelected {
            personGender = "Female"
            btnMaleDidTap(cell.btnMale)
            cell.viewForButtonSelectedGreenView.backgroundColor = #colorLiteral(red: 0.2862745098, green: 0.768627451, blue: 0.09019607843, alpha: 1)
        }else {
            
            cell.viewForButtonSelectedGreenView.backgroundColor = #colorLiteral(red: 0.7803921569, green: 0.7803921569, blue: 0.8, alpha: 1)
        }
        
        
    }
    @objc func btnMaleDidTap(_ sender: UIButton) {
        
        let cell:SignUpProfileDetailsTableViewCell1 = tblView.cellForRow(at: IndexPath(row: 0, section: 0)) as! SignUpProfileDetailsTableViewCell1
        isBtnGenderSelected = !isBtnGenderSelected
        if isBtnGenderSelected {
            personGender = "Male"
            btnFemaleDidTap(cell.btnFemale)
            cell.viewForMalebuttonSelectedGreenview.backgroundColor = #colorLiteral(red: 0.2862745098, green: 0.768627451, blue: 0.09019607843, alpha: 1)
        }else {
            
            cell.viewForMalebuttonSelectedGreenview.backgroundColor = #colorLiteral(red: 0.7803921569, green: 0.7803921569, blue: 0.8, alpha: 1)
        }
        
    }
    
}
//MARK:- UITableViewDataSource
extension LoginSignUpViewController: UITableViewDataSource {
    func numberOfSections(in tableView: UITableView) -> Int {
        return 3
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return 1
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        /*switch indexPath.section {
        case 0:
            let cell = tblView.dequeueReusableCell(withIdentifier: "SignUpProfileDetailsTableViewCell1", for: indexPath) as! SignUpProfileDetailsTableViewCell1
            let tapGestureRecognizer = UITapGestureRecognizer(target: self, action: #selector(imgViewForProfilePictureDidTap(tapGestureRecognizer:)))
            cell.imgViewForProfilePicture.isUserInteractionEnabled = true
           // cell.imgViewForProfilePicture.removeCornerForView()
            cell.imgViewForProfilePicture.addGestureRecognizer(tapGestureRecognizer)
            cell.txtBirthDay.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.txtBirthMonth.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.txtBirthYear.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.txtFirstName.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.txtLastName.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.btnFemale.addTarget(self, action: #selector(btnFemaleDidTap(_:)), for: .touchUpInside)
            cell.btnMale.addTarget(self, action: #selector(btnMaleDidTap(_:)), for: .touchUpInside)
            // cell.btnDateOfBirth.addTarget(self, action: #selector(btnDateOfBirthDidTap(_:)), for: .touchUpInside)
            return cell
        case 1:
            let cell = tblView.dequeueReusableCell(withIdentifier: "SignUpProfileDetailsTableViewCell2", for: indexPath) as! SignUpProfileDetailsTableViewCell2
            cell.txtEmailAdd.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.txtPassword.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.txtConfirmPasswrd.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.txtForCountryCode.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.txtforMobileNumber.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.txtforMobileNumber.keyboardType = .phonePad
            
            return cell
        default:
            /*let cell = tblView.dequeueReusableCell(withIdentifier: "SignUpButtonTableViewCell", for: indexPath) as! SignUpButtonTableViewCell
            cell.btnSignUp.addTarget(self, action: #selector(btnSignUpDidTap(_:)), for: .touchUpInside)
            return cell*/
            let cell = tblView.dequeueReusableCell(withIdentifier: "SignUpProfileDetailsTableViewCell1", for: indexPath) as! SignUpProfileDetailsTableViewCell1
            let tapGestureRecognizer = UITapGestureRecognizer(target: self, action: #selector(imgViewForProfilePictureDidTap(tapGestureRecognizer:)))
            cell.imgViewForProfilePicture.isUserInteractionEnabled = true
           // cell.imgViewForProfilePicture.removeCornerForView()
            cell.imgViewForProfilePicture.addGestureRecognizer(tapGestureRecognizer)
            cell.txtBirthDay.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.txtBirthMonth.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.txtBirthYear.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.txtFirstName.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.txtLastName.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.btnFemale.addTarget(self, action: #selector(btnFemaleDidTap(_:)), for: .touchUpInside)
            cell.btnMale.addTarget(self, action: #selector(btnMaleDidTap(_:)), for: .touchUpInside)
            // cell.btnDateOfBirth.addTarget(self, action: #selector(btnDateOfBirthDidTap(_:)), for: .touchUpInside)
            return cell
        }*/
        
        if indexPath.section == 0{
            let cell = tblView.dequeueReusableCell(withIdentifier: "SignUpProfileDetailsTableViewCell1", for: indexPath) as! SignUpProfileDetailsTableViewCell1
            let tapGestureRecognizer = UITapGestureRecognizer(target: self, action: #selector(imgViewForProfilePictureDidTap(tapGestureRecognizer:)))
            cell.imgViewForProfilePicture.isUserInteractionEnabled = true
           // cell.imgViewForProfilePicture.removeCornerForView()
            cell.imgViewForProfilePicture.addGestureRecognizer(tapGestureRecognizer)
            cell.txtBirthDay.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.txtBirthMonth.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.txtBirthYear.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.txtFirstName.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.txtLastName.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.btnFemale.addTarget(self, action: #selector(btnFemaleDidTap(_:)), for: .touchUpInside)
            cell.btnMale.addTarget(self, action: #selector(btnMaleDidTap(_:)), for: .touchUpInside)
            // cell.btnDateOfBirth.addTarget(self, action: #selector(btnDateOfBirthDidTap(_:)), for: .touchUpInside)
            return cell
        }else if indexPath.section == 1{
            let cell = tblView.dequeueReusableCell(withIdentifier: "SignUpProfileDetailsTableViewCell2", for: indexPath) as! SignUpProfileDetailsTableViewCell2
            cell.txtEmailAdd.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.txtPassword.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.txtConfirmPasswrd.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.txtForCountryCode.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.txtforMobileNumber.addTarget(self, action: #selector(self.textFieldDidChange(_:)), for: .editingChanged)
            cell.txtforMobileNumber.keyboardType = .phonePad
            
            return cell
        }else{
            let cell = tblView.dequeueReusableCell(withIdentifier: "SignUpButtonTableViewCell") as! SignUpButtonTableViewCell
            //dequeueReusableCell(withIdentifier: "SignUpButtonTableViewCell", for: indexPath) as! SignUpButtonTableViewCell
            cell.btnSignUp.addTarget(self, action: #selector(btnSignUpDidTap(_:)), for: .touchUpInside)
            return cell
        }
        
    }
    
    /*func tableView(_ tableView: UITableView, viewForFooterInSection section: Int) -> UIView? {
        let cell = tblView.dequeueReusableCell(withIdentifier: "SignUpButtonTableViewCell") as! SignUpButtonTableViewCell
        //dequeueReusableCell(withIdentifier: "SignUpButtonTableViewCell", for: indexPath) as! SignUpButtonTableViewCell
        cell.btnSignUp.addTarget(self, action: #selector(btnSignUpDidTap(_:)), for: .touchUpInside)
        return cell
    }
    
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        
        if section == 1{
            return 75
        }else{
            return 0
        }
    }*/
    
}


//MARK:- UITableViewDelegate
extension LoginSignUpViewController: UITableViewDelegate {
    func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        /*switch indexPath.section {
        case 0:
            return 320
        case 1:
            return 280
        default:
            return 320
        }*/
        if indexPath.section == 0{
            return 296
        }else if indexPath.section == 1{
            return 226
        }else{
            return 75
        }
    }
    
    
}
//MARK:- imagePickerController
extension LoginSignUpViewController {
    @objc func imgViewForProfilePictureDidTap(tapGestureRecognizer: UITapGestureRecognizer)
    {
        if UIImagePickerController.isSourceTypeAvailable(.photoLibrary){
            print("Button capture")
            imagePicker.sourceType = .photoLibrary
            imagePicker.delegate = self
            imagePicker.allowsEditing = true
            present(imagePicker, animated: true, completion: nil)
        }else {
            let alertController = UIAlertController(title: nil, message: "Device has no photoLibrary.", preferredStyle: .alert)
            let okAction = UIAlertAction(title: "Alright", style: .default, handler: { (alert: UIAlertAction!) in
            })
            alertController.addAction(okAction)
            self.present(alertController, animated: true, completion: nil)
        }
    }
    
    func imagePickerController(_ picker: UIImagePickerController, didFinishPickingMediaWithInfo info: [UIImagePickerController.InfoKey : Any]) {
        
        if let image = info[UIImagePickerController.InfoKey.editedImage] as? UIImage {
            self.selectedProfileImage = image
            let cell:SignUpProfileDetailsTableViewCell1 = tblView.cellForRow(at: IndexPath(row: 0, section: 0)) as! SignUpProfileDetailsTableViewCell1
            //cell.imgViewForProfilePicture.addCornerForView()
            cell.imgViewForProfilePicture.image = image
        }
        imagePicker.dismiss(animated: true, completion: nil)
    }
}
//MARK: - UIDatePicker
extension LoginSignUpViewController {
    
    override func touchesBegan(_ touches: Set<UITouch>, with event: UIEvent?) {
        // let touch: UITouch? = touches.first
        
        // if touch?.view != datePicker {
        //            datePicker.isHidden = true
        self.view.endEditing(true)
        /// }
    }
}


extension String {
    //yyyy-MM-dd
    func toDate(withFormat format: String = "dd-mm-yyyy")-> Date?{
        
        let dateFormatter = DateFormatter()
        dateFormatter.dateFormat = format
        
        //dateFormatter.locale = Locale(identifier: NSLocale.current.identifier)
        let date = dateFormatter.date(from: self)
        return date
    }
    
}

//MARK:
extension LoginSignUpViewController: UITextFieldDelegate {
    func textFieldDidBeginEditing(_ textField: UITextField) {
        //        datePicker.isHidden = true
    }
    
    
    func textField(_ textField: UITextField, shouldChangeCharactersIn range: NSRange, replacementString string: String) -> Bool {
        switch textField.tag {
        case 31:
            if textField.text?.count ?? 0 >= 2 {
                if range.location <= 1 {
                    return true
                }else {
                    return false
                }
            }else {
                return true
            }
        case 32:
            if textField.text?.count ?? 0 >= 2 {
                if range.location <= 1 {
                    return true
                }else {
                    return false
                }
            }else {
                return true
            }
        case 33:
            if textField.text?.count ?? 0 >= 4 {
                if range.location <= 3 {
                    return true
                }else {
                    return false
                }
            }else {
                return true
            }
        case 8:
            let allowedCharacters = CharacterSet(charactersIn:"0123456789")//Here change this characters based on your requirement
            let characterSet = CharacterSet(charactersIn: string)
            return allowedCharacters.isSuperset(of: characterSet)
        default:
            return true
        }
    }
    
    func textFieldDidEndEditing(_ textField: UITextField) {
        switch textField.tag {
        case 31:
            if textField.text != "" {
            let value = Int(textField.text!)
                if value! > 31 {
                    textField.text = ""
                    showDefaultAlert(viewController: self, title: "", msg: "Please enter a valid day")
                }
            }
        case 32:
            if textField.text != "" {
            let value = Int(textField.text!)
                if value! > 12 {
                    textField.text = ""
                    showDefaultAlert(viewController: self, title: "", msg: "Please enter a valid month")
                }
            }
        
        default:
            print("")
        }
    }
    
    @objc func textFieldDidChange(_ textfield: UITextField) {
        switch textfield.tag {
        case 1:
            firstName = textfield.text ?? ""
        case 2:
            lastName = textfield.text ?? ""
        case 31:
            birthDay = textfield.text ?? ""
        case 32:
            birthMonth = textfield.text ?? ""
        case 33:
            birthYear = textfield.text ?? ""
        case 4:
            emailAddress = textfield.text ?? ""
        case 5:
            password = textfield.text ?? ""
        case 6:
            confirmPassword = textfield.text ?? ""
        case 7:
            contryCode = textfield.text ?? ""
        default:
            mobileNumber = textfield.text ?? ""
        }
    }
    
    func textFieldShouldBeginEditing(_ textField: UITextField) -> Bool {
        if textField.tag == 3 {
            return false
        } else {
            if textField.tag  == 7 {
                openCountryListPopup()
                return false
                
            }
            return true
        }
    }
    
    
}
//MARK:- CountryCodePopUpDelegate
extension LoginSignUpViewController: CountryCodePopUpDelegate{
    func selectedCountryDetails(Countrydetails: CountryDetailsDataStruct) {
        
        contryCode = Countrydetails.countryCode
        countryName = Countrydetails.countryName
        let cell:SignUpProfileDetailsTableViewCell2 = tblView.cellForRow(at: IndexPath(row: 0, section: 1)) as! SignUpProfileDetailsTableViewCell2
        cell.txtForCountryCode.text = contryCode
        cell.txtForCountryCode.textAlignment = .right
        cell.country = Countrydetails.countryName
        cell.txtForCountryCode.setRightPaddingPoints(10)
        cell.imgViewForCountryCode.image = UIImage(named: Countrydetails.countryFlag )
    }
    
}

//MARK:- Login With Details
extension LoginSignUpViewController {
    
    func loginWithDetails(emailID:String,password:String,deviceToken:String)  {
        
        var deviceeToken = ""
        if let token = UserDefaults.standard.value(forKey: "kDeviceToken") {
            deviceeToken = token as! String
        }else{
            deviceeToken = ""
        }
        openAlertPopup(selfVc: self, alertMessage: "Processing...".localized(), showAlert: true)
        ServiceManager.sharedInstance.postMethodAlamofire("api/login", dictionary: ["email":emailID,"password":password,"device_token":deviceeToken], withHud: false) { (success, response, error) in
            openAlertPopup(selfVc: self, alertMessage: "Processing...".localized(), showAlert: false)
            if success {
                if response!["status"] as! Bool == true {
                    self.isUserLogin = true
                    self.logginOffTimer()
                    let userDict = ((response as! NSDictionary)["user_details"] as! NSDictionary)
                    CAUser.currentUser.initWithDictionary(userDictionary: userDict)
                    CAUser.saveLoggedUserdetails(dictDetails: userDict)
                    let responseMsg = ((response as! NSDictionary)["message"] as! String)
                    
                    //showDefaultAlert(viewController: self, title: "", msg: responseMsg)
                    if self.isFromNoLogin == true{
                        DispatchQueue.main.async {
                            let alert = UIAlertController(title: "Message".localized(), message: "Successfully Logged In".localized(), preferredStyle: .alert)
                            alert.addAction(UIAlertAction(title: "OK", style: .default, handler: { action in
                                self.navigationController?.popViewController(animated: true)
                            }))
                            self.present(alert, animated: true, completion: nil)
                        }
                    }else{
                        showCustomAlert(title: "Successfully Logged In".localized(), message: "", isError: false)
                        redirectingToHomeScreen()
                    }
                    
                }else {
                    let responseMsg = ((response as! NSDictionary)["message"] as! String)
                    showDefaultAlert(viewController: self, title: "Error", msg: responseMsg)
                }
                
            }else{
                showDefaultAlert(viewController: self, title: "", msg: "Failed")
            }
        }
    }
    //MARK:- Register With Details
    func userRegisterWithDetails(frstName:String,lastName:String,emailID:String,password:String,deviceToken:String,phone:String,dob:String,gender:String,country:String,countryCode:String)  {
        /*openAlertPopup(selfVc: self, alertMessage: "Processing...", showAlert: true)
        ServiceManager.sharedInstance.postMethodAlamofire("api/register", dictionary: ["fname":frstName,"lname":lastName,"email":emailID,"password":password,"device_token":deviceToken,"phone":phone,"dob":dob,"gender":gender,"country":country,"country_code":countryCode], withHud: false) { (success, response, error) in
            let responseMsg = ((response as! NSDictionary)["message"] as! String)
            openAlertPopup(selfVc: self, alertMessage: "Processing...", showAlert: false)
            if success {
                if response!["status"] as! Bool == true {
                    showCustomAlert(title: responseMsg, message: "", isError: false)
                    let userDict = ((response as! NSDictionary)["user_details"] as! NSDictionary)
                    CAUser.currentUser.initWithDictionary(userDictionary: userDict)
                    CAUser.saveLoggedUserdetails(dictDetails: userDict)
                    let otpVal = ((response as! NSDictionary)["otp"] as! Int)
                    
                    let nextVC = UIStoryboard(name: "Profile", bundle: Bundle.main).instantiateViewController(withIdentifier: "ConfirmationCodeViewController") as! ConfirmationCodeViewController
                    nextVC.otpFrom = VerificationCodeFrom.signUp
                    nextVC.otpValue = otpVal
                    nextVC.userId = userDict["id"] as? Int
                    nextVC.userEmailAddress = userDict["email"] as? String
                    self.navigationController?.pushViewController(nextVC, animated: true)
                }else {
                    showDefaultAlert(viewController: self, title: "", msg: responseMsg)
                }
            }else{
                showDefaultAlert(viewController: self, title: "", msg: "Failed")
            }
        }*/
        
        var deviceeToken = ""
        if let token = UserDefaults.standard.value(forKey: "kDeviceToken") {
            deviceeToken = token as! String
        }else{
            deviceeToken = ""
        }
        var imageData = Data()
        var fileName = ""
        if selectedProfileImage != nil{
            imageData = self.selectedProfileImage.jpegData(compressionQuality: 0.8)!
            fileName = "image"
        }else{
            imageData = Data()
            fileName = ""
        }
        openAlertPopup(selfVc: self, alertMessage: "Processing...", showAlert: true)
        ServiceManager.sharedInstance.uploadSingleData("api/register", parameters: ["fname":frstName,"lname":lastName,"email":emailID,"password":password,"device_token":deviceeToken,"phone":phone,"dob":dob,"gender":gender,"country":countryName,"country_code":countryCode,"userid":CAGuestUser.currentUser.id != nil ? "\(CAGuestUser.currentUser.id!)" : ""], imgdata: imageData, filename: fileName, withHud: false) { (success, response, error) in
            let responseMsg = ((response as! NSDictionary)["message"] as! String)
            openAlertPopup(selfVc: self, alertMessage: "Processing...", showAlert: false)
            if success {
                if response!["status"] as! Bool == true {
                    showCustomAlert(title: responseMsg, message: "", isError: false)
                    let userDict = ((response as! NSDictionary)["user_details"] as! NSDictionary)
                    CAUser.currentUser.initWithDictionary(userDictionary: userDict)
                    CAUser.saveLoggedUserdetails(dictDetails: userDict)
                    let otpVal = ((response as! NSDictionary)["otp"] as! Int)
                    
                    DispatchQueue.main.async {
                        let nextVC = UIStoryboard(name: "Profile", bundle: Bundle.main).instantiateViewController(withIdentifier: "ConfirmationCodeViewController") as! ConfirmationCodeViewController
                        nextVC.otpFrom = VerificationCodeFrom.signUp
                        nextVC.otpValue = otpVal
                        nextVC.userId = userDict["id"] as? Int
                        nextVC.userEmailAddress = userDict["email"] as? String
                        self.navigationController?.pushViewController(nextVC, animated: true)
                    }
                    
                }else {
                    showDefaultAlert(viewController: self, title: "", msg: responseMsg)
                }
            }else{
                showDefaultAlert(viewController: self, title: "", msg: error?.localizedDescription ?? "Failed...!")
            }
        }
        
    }
}

extension LoginSignUpViewController {
    func openCountryListPopup(){
        guard let countryCodePopup = UIStoryboard(name: "Profile", bundle: Bundle.main).instantiateViewController(withIdentifier: "CountryCodePopUpViewController") as? CountryCodePopUpViewController else {
            return
        }
        countryCodePopup.countryCodePopUpDelegate = self
        countryCodePopup.modalTransitionStyle = .crossDissolve
        countryCodePopup.modalPresentationStyle = .overCurrentContext
        tabBarController?.present(countryCodePopup, animated: true)
    }
    
    
    
}

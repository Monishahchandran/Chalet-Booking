//
//  MyAccountTVC.swift
//  AbyChaletApp
//
//  Created by Visakh Srishti on 25/05/21.
//

import UIKit
import SkyFloatingLabelTextField
import SDWebImage

class MyAccountTVC: UITableViewController {

    @IBOutlet weak var txtFldFrstName: SkyFloatingLabelTextField!
    @IBOutlet weak var txtFldLastName: SkyFloatingLabelTextField!
    @IBOutlet weak var txtFldEmailAddress: SkyFloatingLabelTextField!
    @IBOutlet weak var imgFlag: UIImageView!
    @IBOutlet weak var tctFldCountryCode: SkyFloatingLabelTextField!
    @IBOutlet weak var tctFldPhoneNumber: SkyFloatingLabelTextField!
    @IBOutlet weak var btnMale: UIButton!
    @IBOutlet weak var btnFemale: UIButton!
    @IBOutlet weak var viewTop: UIView!
    @IBOutlet weak var viewBottom: UIView!
    @IBOutlet weak var viewUpdateBtn: UIView!
    @IBOutlet weak var imgViewProfilePic: UIImageView!
    var selectedProfileImage : UIImage!
    var imagePicker = UIImagePickerController()

    var gender = ""
    
    var countryDetailsArray: [CountryDetailsDataStruct] = [
        CountryDetailsDataStruct(countryCode: "+971", countryName: "United Arab Emirates", countryFlag: "icn_UAE"),
        CountryDetailsDataStruct(countryCode: "+966", countryName: "Saudi Arabia", countryFlag: "icn_SA"),
        CountryDetailsDataStruct(countryCode: "+974", countryName: "Qatar", countryFlag: "icn_QA"),
        CountryDetailsDataStruct(countryCode: "+968", countryName: "Oman", countryFlag: "icn_OM"),
        CountryDetailsDataStruct(countryCode: "+973", countryName: "Bahrain", countryFlag: "icn_BH"),
        CountryDetailsDataStruct(countryCode: "+965", countryName: "Kuwait", countryFlag: "icn_KW")
    ]
    
    
    override func viewDidLoad() {
        super.viewDidLoad()

        self.setUpNavigationBar()
        self.setuValuesToFields()
        self.setupUI()
    }
    
    override func viewDidLayoutSubviews() {
        self.viewTop.roundCorners(corners: [.topLeft,.topRight], radius: 10.0)
        self.viewBottom.roundCorners(corners: [.bottomLeft,.bottomRight], radius: 10.0)
        
    }

    override func viewWillDisappear(_ animated: Bool) {
        viewUpdateBtn.removeFromSuperview()
    }
    //MARK:- SetUp NavigationBar
    func setUpNavigationBar() {
        self.navigationController?.navigationBar.isHidden = false
        self.navigationController?.navigationBar.isTranslucent = false

        self.navigationController?.navigationBar.barTintColor = kAppThemeColor
        self.navigationItem.setHidesBackButton(true, animated: true)
        let backBarButton = UIBarButtonItem(image: Images.kIconBackGreen, style: .plain, target: self, action: #selector(backButtonTouched))
        self.navigationItem.leftBarButtonItems = [backBarButton]
        let notificationButton = UIBarButtonItem(image: Images.kIconNotification, style: .plain, target: self, action: #selector(notificationButtonTouched))
        self.navigationItem.rightBarButtonItems = [notificationButton]
        self.navigationItem.title = "My Account"
        self.navigationController?.navigationBar.titleTextAttributes = [NSAttributedString.Key.foregroundColor: UIColor.white]

    }
    
    //MARK:- SetupUI
    func setupUI()  {
        viewUpdateBtn.frame = CGRect(x: 0, y: kScreenHeight - 130, width: kScreenWidth, height: 130)
        appDelegate.window?.addSubview(viewUpdateBtn)
        tctFldCountryCode.placeholderFont = UIFont(name: "Roboto-Medium", size: 13)!

    }
    
    //MARK:- SetValuesToFields
    func setuValuesToFields() {
    
        self.txtFldFrstName.text = CAUser.currentUser.first_name!
        self.txtFldLastName.text = CAUser.currentUser.last_name!
        self.txtFldEmailAddress.text = CAUser.currentUser.email!
        self.tctFldPhoneNumber.text = CAUser.currentUser.phone!
        self.tctFldCountryCode.text = CAUser.currentUser.country_code!
        if CAUser.currentUser.gender == "Female"{
            gender = "Female"
            btnFemale.isSelected = true
            btnMale.isSelected = false
        }else{
            btnFemale.isSelected = false
            btnMale.isSelected = true
            gender = "Male"
        }
        for dict in countryDetailsArray {
            print(dict.countryCode)
            print(CAUser.currentUser.country_code!)
            if CAUser.currentUser.country_code == dict.countryCode {
                self.imgFlag.image = UIImage(named: dict.countryFlag )
                break
            }
        }
        
        if CAUser.currentUser.profile_pic != nil{
            if CAUser.currentUser.profile_pic != "" {
                self.imgViewProfilePic.sd_setImage(with: URL(string: CAUser.currentUser.profile_pic!), placeholderImage: kPlaceHolderImage, options: .highPriority) { image, error, cache, url in
                    if image != nil{
                        self.imgViewProfilePic.image = image
                    }else{
                        self.imgViewProfilePic.image = CAUser.currentUser.gender == "Female" ? kFemalePlaceHolderImage : kMalePlaceHolderImage
                    }
                }
            }else{
                self.imgViewProfilePic.image = CAUser.currentUser.gender == "Female" ? kFemalePlaceHolderImage : kMalePlaceHolderImage
            }
            
        }else{
            self.imgViewProfilePic.image = CAUser.currentUser.gender == "Female" ? kFemalePlaceHolderImage : kMalePlaceHolderImage
        }
        
        
    }
    
    //MARK:- ButtonActions
    //MARK:- Done button action keyboard
    @objc func doneButtonClicked() {
        self.view.endEditing(true)
    }
    @objc func backButtonTouched()  {
        
        self.navigationController?.popViewController(animated: true)
    }
    @objc func notificationButtonTouched()  {
        
        
    }
    @IBAction func btnGenderAction(_ sender: UIButton) {
        
        switch sender.tag {
        case 0:
            self.btnFemale.isSelected = true
            self.btnMale.isSelected = false
            self.gender = "Female"
        case 1:
            self.btnFemale.isSelected = false
            self.btnMale.isSelected = true
            self.gender = "Male"
        default:
            self.btnMale.isSelected = false
            self.gender = "Female"
        }
    }
    @IBAction func btnSelectProfileAction(_ sender: UIButton) {
        
        if UIImagePickerController.isSourceTypeAvailable(.photoLibrary){
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
    @IBAction func buttonUpdateAction(_ sender: UIButton) {
        
        if txtFldFrstName.hasText && txtFldLastName.hasText && txtFldEmailAddress.hasText && tctFldPhoneNumber.hasText && tctFldCountryCode.hasText  {
            if isValidEmail(txtFldEmailAddress.text!) == true{
                if limitValidation(string: tctFldPhoneNumber.text!, minLength: 6, maxLength: 14){
                    self.updateProfile(firstName: txtFldFrstName.text!, lastName: txtFldLastName.text!, email: txtFldEmailAddress.text!, countryCode: tctFldCountryCode.text!, phone: tctFldPhoneNumber.text!, gender: self.gender)
                }else{
                    showDefaultAlert(viewController: self, title: "", msg: "Please Enter Minimum 6 and Maximum 14 Characters In Mobile Number")
                }
            }else{
                showDefaultAlert(viewController: self, title: "Message", msg: "Please enter a valid email address")
            }
        }else{
            showDefaultAlert(viewController: self, title: "Message", msg: "Please fill all fields")
        }
    }
    
}
extension MyAccountTVC : UITextFieldDelegate {
    
    func textFieldShouldBeginEditing(_ textField: UITextField) -> Bool {
        if textField == tctFldCountryCode{
            self.openCountryListPopup()
            return false
        }
        return true
    }
    
    
    func textField(_ textField: UITextField, shouldChangeCharactersIn range: NSRange, replacementString string: String) -> Bool {
        
        if textField == tctFldPhoneNumber {
            let allowedCharacters = CharacterSet(charactersIn:"0123456789")//Here change this characters based on your requirement
            let characterSet = CharacterSet(charactersIn: string)
            return allowedCharacters.isSuperset(of: characterSet)
        }
        
        return true
        
    }
    
    
}
extension MyAccountTVC : CountryCodePopUpDelegate{
    
    func openCountryListPopup(){
        guard let countryCodePopup = UIStoryboard(name: "Profile", bundle: Bundle.main).instantiateViewController(withIdentifier: "CountryCodePopUpViewController") as? CountryCodePopUpViewController else {
            return
        }
        countryCodePopup.countryCodePopUpDelegate = self
        countryCodePopup.modalTransitionStyle = .crossDissolve
        countryCodePopup.modalPresentationStyle = .overCurrentContext
        tabBarController?.present(countryCodePopup, animated: true)
    }
    
    func selectedCountryDetails(Countrydetails: CountryDetailsDataStruct) {
        
        self.tctFldCountryCode.text = Countrydetails.countryCode
        self.tctFldCountryCode.textAlignment = .left
        self.tctFldCountryCode.setRightPaddingPoints(1)
        self.imgFlag.image = UIImage(named: Countrydetails.countryFlag )
    }
    
    
}
extension MyAccountTVC {
    
    func updateProfile(firstName:String,lastName:String,email:String,countryCode:String,phone:String,gender:String) {
       /* ServiceManager.sharedInstance.postMethodAlamofire("api/updateprofile", dictionary: ["id":CAUser.currentUser.id!,"first_name":firstName,"last_name":lastName,"email":email,"phone":phone,"gender":gender,"country_code":countryCode], withHud: true) { (success, response, error) in
            if success {
                if response!["status"] as! Bool == true {
                    let userDict = ((response as! NSDictionary)["user_details"] as! NSDictionary)
                    CAUser.currentUser.initWithDictionary(userDictionary: userDict)
                    CAUser.saveLoggedUserdetails(dictDetails: userDict)
                    DispatchQueue.main.async {
                        showDefaultAlert(viewController: self, title: "Success", msg: "Your account details have been updated")
                        self.setuValuesToFields()
                    }
                }else{
                    showDefaultAlert(viewController: self, title: "", msg: response!["message"] as! String)
                }
            }else{
                showDefaultAlert(viewController: self, title: "", msg: "Failed..!")
            }
        }*/
        
        var imageData = Data()
        if selectedProfileImage != nil{
            imageData = self.selectedProfileImage.jpegData(compressionQuality: 0.8)!
        }else{
            imageData = Data()
        }
        ServiceManager.sharedInstance.uploadSingleData("api/updateprofile", parameters: ["id":CAUser.currentUser.id!,"first_name":firstName,"last_name":lastName,"email":email,"phone":phone,"gender":gender,"country_code":countryCode], imgdata: imageData, filename: "image", withHud: true) { (success, response, error) in
            if success {
                if response!["status"] as! Bool == true {
                    let userDict = ((response as! NSDictionary)["user_details"] as! NSDictionary)
                    CAUser.currentUser.initWithDictionary(userDictionary: userDict)
                    CAUser.saveLoggedUserdetails(dictDetails: userDict)
                    DispatchQueue.main.async {
                        showDefaultAlert(viewController: self, title: "Success", msg: "Your account details have been updated")
                        self.setuValuesToFields()
                    }
                }else{
                    showDefaultAlert(viewController: self, title: "", msg: response!["message"] as! String)
                }
            }else{
                showDefaultAlert(viewController: self, title: "", msg: "Failed")
            }
        }
        
    }
    
}
extension MyAccountTVC : UINavigationControllerDelegate, UIImagePickerControllerDelegate {
    
    func imagePickerController(_ picker: UIImagePickerController, didFinishPickingMediaWithInfo info: [UIImagePickerController.InfoKey : Any]) {
        if let image = info[UIImagePickerController.InfoKey.editedImage] as? UIImage {
            self.selectedProfileImage = image
            self.imgViewProfilePic.image = image
        }
        imagePicker.dismiss(animated: true, completion: nil)
    }
    
}

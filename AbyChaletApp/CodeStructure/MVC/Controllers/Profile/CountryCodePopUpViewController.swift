//
//  CountryCodePopUpViewController.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 11/05/21.
//

import UIKit

struct CountryDetailsDataStruct {
    var countryCode: String
    var countryName: String
    var countryFlag: String
}
protocol CountryCodePopUpDelegate{
    func selectedCountryDetails(Countrydetails:CountryDetailsDataStruct)
}


class CountryCodePopUpViewController: UIViewController {

    @IBOutlet weak var tblView: UITableView!
    @IBOutlet weak var searchBar: UISearchBar!
    @IBOutlet weak var viewForPopUp: UIView!
    var isSearching: Bool = false
   // United Arab Emirates/Dialing code +971
    //Saudi Arabia/Dialing code +966
    //Qatar/Dialing code +974
    //Oman/Dialing code +968
    //Bahrain/Dialing code +973
    //Kuwait/Dialing code +965
    var countryCodePopUpDelegate:CountryCodePopUpDelegate?
    var filteredCountryDetailsArray: [CountryDetailsDataStruct] = []
   /* var countryDetailsArray: [CountryDetailsDataStruct] = [
        CountryDetailsDataStruct(countryCode: "+971", countryName: "United Arab Emirates", countryFlag: "icn_UAE"),
        CountryDetailsDataStruct(countryCode: "+966", countryName: "Saudi Arabia", countryFlag: "icn_SA"),
        CountryDetailsDataStruct(countryCode: "+974", countryName: "Qatar", countryFlag: "icn_QA"),
        CountryDetailsDataStruct(countryCode: "+968", countryName: "Oman", countryFlag: "icn_OM"),
        CountryDetailsDataStruct(countryCode: "+973", countryName: "Bahrain", countryFlag: "icn_BH"),
        CountryDetailsDataStruct(countryCode: "+965", countryName: "Kuwait", countryFlag: "icn_KW")
    ]*/
    
    
    var countryDetailsArray: [CountryDetailsDataStruct] = [
        CountryDetailsDataStruct(countryCode: "+965", countryName: "Kuwait", countryFlag: "icn_KW"),
        CountryDetailsDataStruct(countryCode: "+966", countryName: "Saudi Arabia", countryFlag: "icn_SA"),
        CountryDetailsDataStruct(countryCode: "+971", countryName: "United Arab Emirates", countryFlag: "icn_UAE"),
        CountryDetailsDataStruct(countryCode: "+974", countryName: "Qatar", countryFlag: "icn_QA"),
        CountryDetailsDataStruct(countryCode: "+973", countryName: "Bahrain", countryFlag: "icn_BH"),
        CountryDetailsDataStruct(countryCode: "+968", countryName: "Oman", countryFlag: "icn_OM")
    ]
    
    
    override func viewDidLoad() {
        super.viewDidLoad()
        filteredCountryDetailsArray = countryDetailsArray
        searchBar.addCornerForView()
        searchBar.searchTextField.attributedPlaceholder =  NSAttributedString.init(string: "Search".localized(), attributes: [NSAttributedString.Key.foregroundColor:UIColor.lightGray])
        
        if let textField = self.searchBar.subviews.first?.subviews.flatMap({ $0 as? UITextField }).first {
            textField.subviews.first?.isHidden = true
            textField.textColor = .black
            textField.layer.backgroundColor = UIColor.clear.cgColor
            textField.layer.cornerRadius = 2
            textField.layer.masksToBounds = true
            textField.addBorderForView()
        }
        UITextField.appearance(whenContainedInInstancesOf: [UISearchBar.self]).backgroundColor = .clear

        NotificationCenter.default.addObserver(self, selector: #selector(logoutUser), name: NSNotification.Name(rawValue: NotificationNames.kBlockedUser), object: nil)
    }
    
    
    
    @objc func logoutUser() {
        appDelegate.logOut()
    }
    override func viewDidLayoutSubviews() {
        super.viewDidLayoutSubviews()
        searchBar.addCornerForView()
        searchBar.addBorderForView()
    }
}
//MARK:- UITableViewDelegate
extension CountryCodePopUpViewController: UITableViewDelegate, UITableViewDataSource {
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return filteredCountryDetailsArray.count
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let cell = tblView.dequeueReusableCell(withIdentifier: "CountryCodeListTableViewCell", for: indexPath) as!  CountryCodeListTableViewCell
        cell.countryListDetails = filteredCountryDetailsArray[indexPath.row]
        return cell
        
    }
    func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        return 50
    }
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        countryCodePopUpDelegate?.selectedCountryDetails(Countrydetails: countryDetailsArray[indexPath.row] )
        self.removeExportPopup()
    }
    
    
}
extension CountryCodePopUpViewController {
    override func touchesBegan(_ touches: Set<UITouch>, with event: UIEvent?) {
        let touch: UITouch? = touches.first
        
        if touch?.view != viewForPopUp {
//             self.routeExportDocumentDelegate?.tabBarControllerHide()
             self.removeExportPopup()
        }
    }
    func removeExportPopup(){
        self.willMove(toParent: nil)
//        self.view.removeFromSuperview()
//        self.removeFromParent()
        self.dismiss(animated: true, completion: nil)
    }
}

//MARK: UISearchBarDelegate
extension CountryCodePopUpViewController : UISearchBarDelegate {
    
    func searchBar(_ searchBar: UISearchBar, textDidChange searchText: String) {
        isSearching = true
        if searchText == "" || searchText.isEmpty {
            filteredCountryDetailsArray = countryDetailsArray
            isSearching = false
        } else {
            filteredCountryDetailsArray = countryDetailsArray.filter ({
                $0.countryCode.range(of: searchBar.text!, options: [.caseInsensitive, .diacriticInsensitive ]) != nil ||
                    $0.countryName.range(of: searchBar.text!, options: [.caseInsensitive, .diacriticInsensitive ]) != nil})
        }
        self.tblView.reloadData()
    }

    func searchBarShouldBeginEditing(_ searchBar: UISearchBar) -> Bool {
       // searchBar.showsCancelButton = true
        return true
    }
    
    func searchBarSearchButtonClicked(_ searchBar: UISearchBar) {
        view.endEditing(true)
    }
    
    func searchBarCancelButtonClicked(_ searchBar: UISearchBar) {
        view.endEditing(true)
       // searchBar.showsCancelButton = false
        searchBar.text = nil
      
    }
}

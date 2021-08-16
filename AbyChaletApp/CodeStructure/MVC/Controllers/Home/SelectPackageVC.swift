//
//  SelectPackageVC.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 28/04/21.
//

import UIKit

class SelectPackageVC: UIViewController {
    
    @IBOutlet weak var tblView: UITableView!
    @IBOutlet weak var collectionView: UICollectionView!
    @IBOutlet var calenderContainerView     : UIView!
    let topSelection = "Weekdays"

    
    var topSliderMenuArray:[String] = []
    var topSliderMenuValArray:[String] = []
    var btnMessage = UIButton()
    var selectedIndexPath : IndexPath?
    var previousSelectedIndexPath : Int = 0
    var selectedPackageName:String = ""
    var selectedIndex:Int?

    override func viewDidLoad() {
        super.viewDidLoad()
        topSliderMenuValArray =  ["Holidays and Events".localized(), "Thursday - Wednesday".localized(), "Sunday - Saturday".localized(), "Thursday - Friday - Saturday".localized(),"Sunday - Monday - Tuesday - Wednesday".localized()]
                              
        topSliderMenuArray =  ["Holidays", "Week (B)".localized(), "Week (A)".localized(), "Weekend".localized(), "Weekdays".localized()]
        setupForCustomNavigationTitle(self: self)
        collectionView.allowsMultipleSelection = false
        
        self.navigationItem.setHidesBackButton(true, animated: false)
        addBarButtons()
    }
    lazy var  calenderView: CalenderViewNew = {
        let calenderView = CalenderViewNew.init(theme: MyThemeNew.light, isSelectionEnabled: true)
        calenderView.translatesAutoresizingMaskIntoConstraints=false
        
        return calenderView
    }()
    
    func addBarButtons() {
        btnMessage = UIButton(type: .custom)
        btnMessage.frame = CGRect(x: 0, y: 0, width: 44, height: 44)
        btnMessage.setImage(UIImage(named: "icn_Message"), for: .normal)
        btnMessage.addTarget(self, action: #selector(btnMessageDidTap(sender:)), for: .touchUpInside)
        let barButtonSettings = UIBarButtonItem(customView: btnMessage)
        navigationController?.navigationBar.barTintColor = #colorLiteral(red: 0.1176470588, green: 0.262745098, blue: 0.3333333333, alpha: 1)
        
        self.navigationItem.rightBarButtonItem = barButtonSettings
    }
    
    @objc func btnMessageDidTap(sender: UIButton) {
        
    }

    override func viewDidLayoutSubviews() {
        super.viewDidLayoutSubviews()
     
      
    }

    
}
//MARK:- UICollectionViewDelegate, UICollectionViewDataSource
extension SelectPackageVC : UICollectionViewDelegate, UICollectionViewDataSource, UICollectionViewDelegateFlowLayout {
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        return topSliderMenuArray.count
    }
    
    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "SelectChaletMenuCollectionViewCell", for: indexPath) as! SelectChaletMenuCollectionViewCell
        cell.lblTitle.text = topSliderMenuArray[indexPath.item]
        self.collectionView.scrollToItem(at: IndexPath(row: selectedIndex ?? 0, section: 0), at: [.centeredVertically, .centeredHorizontally], animated: true)

        if selectedIndex == indexPath.row {
                    cell.imgViewBg.image = UIImage(named: "icn_SelectedPackage")
                }else{
                    cell.imgViewBg.image = UIImage(named: "icn_DeselectedPackage")
                }
        cell.isSelected = (selectedIndexPath == indexPath)

        return cell
    }
    
    func collectionView(_ collectionView: UICollectionView, didSelectItemAt indexPath: IndexPath) {
 
        self.selectedIndex = indexPath.row
        DispatchQueue.main.async {
            self.collectionView.reloadData()
            self.tblView.reloadSections([0], with: .none)
        }
        
    }
    
    
    func collectionView(_ collectionView: UICollectionView, layout collectionViewLayout: UICollectionViewLayout, sizeForItemAt indexPath: IndexPath) -> CGSize {
        
        return CGSize(width: 110 , height: collectionView.bounds.size.height)
    }
    func collectionView(_ collectionView: UICollectionView, layout collectionViewLayout: UICollectionViewLayout, minimumLineSpacingForSectionAt section: Int) -> CGFloat {
        return 0.4
    }
}


//MARK:- UITableViewDataSource
extension SelectPackageVC: UITableViewDataSource {
    func numberOfSections(in tableView: UITableView) -> Int {
        return 5
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        switch section {
        case 0, 1, 2, 3:
            return 1
        
        default:
            return 5
        }
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        switch indexPath.section {
        case 0:
            let cell = tblView.dequeueReusableCell(withIdentifier: "HeaderPackageTitleTableViewCell", for: indexPath) as! HeaderPackageTitleTableViewCell
            cell.lblForSelectedChaletInfo.text = topSliderMenuValArray[selectedIndex ?? 0]
            return cell
            
        case 1:
            let cell = tblView.dequeueReusableCell(withIdentifier: "CalendarTableViewCell", for: indexPath) as! CalendarTableViewCell
            return cell
            
        case 2:
            let cell = tblView.dequeueReusableCell(withIdentifier: "SearchButtonTableViewCell", for: indexPath) as! SearchButtonTableViewCell
            return cell
        case 3:
            let cell = tblView.dequeueReusableCell(withIdentifier: "EmptyChaletTableViewCell", for: indexPath) as! EmptyChaletTableViewCell
            return cell
            
        default:
            let cell = tblView.dequeueReusableCell(withIdentifier: "AvailableChaletListTableViewCell", for: indexPath) as! AvailableChaletListTableViewCell
            return cell
        }
    }
    
    
}
//MARK:- UITableViewDelegate
extension SelectPackageVC: UITableViewDelegate {
   
    func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        switch indexPath.section {
        case 0:
            return 98
        case 1:
            return 289
        case 2:
            return 120
        case 3:
            return 50
        default:
            return 175
        }
    }
    
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        if indexPath.section == 4 {
            switch indexPath.row {
            case 0:
                let nextVC = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(identifier: "ReservationTVC") as ReservationTVC
                navigationController?.pushViewController(nextVC, animated: true)
            default:
                let nextVC1 = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(identifier: "ReservationTVC") as ReservationTVC
                navigationController?.pushViewController(nextVC1, animated: true)
            }
        }
    }
}
extension SelectPackageVC {
    
    
    
    
    func setupCalenderView() {
        
        calenderContainerView.layer.masksToBounds = true
        calenderContainerView.layer.cornerRadius = 0.0
        calenderContainerView.layer.borderWidth = 0.5
        calenderContainerView.layer.borderColor = UIColor.lightGray.cgColor
        
        calenderContainerView.addSubview(calenderView)
        calenderView.delegate = self
        calenderView.topAnchor.constraint(equalTo: calenderContainerView.topAnchor, constant: 0).isActive=true
        calenderView.rightAnchor.constraint(equalTo: calenderContainerView.rightAnchor, constant: 0).isActive=true
        calenderView.leftAnchor.constraint(equalTo: calenderContainerView.leftAnchor, constant: 0).isActive=true
        calenderView.heightAnchor.constraint(equalToConstant: 425).isActive=true
        //calenderView.bookedSlotDate = [10, 12, 15, 18, 20]
        calenderView.myCollectionView.reloadData()
    }
    
    
}
extension SelectPackageVC : CalenderDelegateNew {
    func delegateChaletReserved() {
        
    }
    
    
    
    func didTapDate(day: Int, date: String, available: Bool, selectedDates: [String]) {
        
        if topSelection == "Weekdays"{
            
            
        }else{
            
            //self.showAlertWithOkButton(message: "Chalet is not available".localized())
        }
        
        print(selectedDates)
        
        
        if selectedDates.count > 0 {
            //self.searchChalet(fromDate: convertDateFormat(dateString: selectedDates.first!), toDate: convertDateFormat(dateString: selectedDates.last!), selectedPackage: "weekdays")
        }
    }
    
    func noChaletAvailable() {
//        self.showAlertWithOkButton(message: "Chalet is not available".localized())
    }
    
   
    func didChangeMonth(monthIndex: Int, year: Int) {
        //print(monthIndex)
        //print(year)
    }
    func showPopupMaxLimit() {
        print("Maximum 30 dates can be selected")
    }
    
    func getDayName(selectedDate:String) -> String {

        let dateFormatter = DateFormatter()
        dateFormatter.dateFormat = "MM-dd-yyyy"
        let date = dateFormatter.date(from: selectedDate)
        dateFormatter.dateFormat = "EEEE"
        let dayInWeek = dateFormatter.string(from: date!)
        return dayInWeek
    }
}

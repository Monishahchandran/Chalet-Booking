//
//  SelectPackageTVC.swift
//  AbyChaletApp
//
//  Created by Visakh Srishti on 16/05/21.
//

import UIKit

class SelectPackageTVC: UITableViewController {

    @IBOutlet weak var collectionView: UICollectionView!
    @IBOutlet weak var lblForSelectedChaletInfo: UILabel!
    @IBOutlet weak var viewForCalenderContaintView: UIView!
    @IBOutlet weak var viewTop: UIView!
    @IBOutlet weak var btnSearch: UIButton!
    @IBOutlet weak var collectionChalletList: UICollectionView!
    @IBOutlet weak var colletionViewHolidays: UICollectionView!
    var  arrayListCalender  = [JobsPerDate]()

    var topSliderMenuArray:[String] = []
    var topSliderMenuValArray:[String] = []
    var btnMessage = UIButton()
    var selectedIndexPath : IndexPath?
    var previousSelectedIndexPath : Int = 0
    var selectedPackageName:String = ""
    var selectedIndex:Int?
    var topSelection = ""
    var arrayUserDetails = [User_details]()
    var arrayCalendarList = [CalendarData]()
    var arrayChalletList = [Chalet_list]()
    var dictBookingDetails = Booking_details(dictionary: NSDictionary())
    var isNoChaletFound = false
    var isSearchEnable = false
    var startDate = ""
    var endDate = ""
    var isLoadHolidaysAndEvents = false
    var holidaySelectedIndex = 0
    var calendarHeight : CGFloat = 425
    var selectedIndexHolidays = 0
    @IBOutlet var calenderContainerView     : UIView!
    @IBOutlet weak var lblAvailableChalets: UILabel!
    var arrayValuesToBackEnd = ["holidays","weekB","weekA","weekend","weekdays"]
    
    override func viewDidLoad() {
        super.viewDidLoad()

        
        
        self.topSelection = arrayValuesToBackEnd[selectedIndex ?? 0]
        
        if topSelection == "holidays"{
            self.isLoadHolidaysAndEvents = true
            self.getHolidayPackage()
        }else{
            self.isLoadHolidaysAndEvents = false
        }
        
        topSliderMenuValArray =  ["Holidays and Events".localized(), "Thursday - Wednesday".localized(), "Sunday to Saturday".localized(), "Thursday - Friday - Saturday".localized(),"Sunday - Monday - Tuesday - Wednesday".localized()]
                              //Sunday-Monday-Tuesday-Wednesday
        topSliderMenuArray =  ["Holidays", "Week (B)".localized(), "Week (A)".localized(), "Weekend".localized(), "Weekdays".localized()]
        setupForCustomNavigationTitle(self: self)
        collectionView.allowsMultipleSelection = false
        self.navigationController?.navigationBar.isTranslucent = false
        navigationController?.navigationBar.barTintColor = kAppHeaderColor

        self.navigationItem.setHidesBackButton(true, animated: false)
        self.addBarButtons()
        self.setupUI()
        self.setupCalenderView()
                
        NotificationCenter.default.addObserver(self, selector: #selector(logoutUser), name: NSNotification.Name(rawValue: NotificationNames.kBlockedUser), object: nil)
    }
    @objc func logoutUser() {
        
        appDelegate.logOut()
        
    }
    override func viewWillAppear(_ animated: Bool) {
        appDelegate.checkBlockStatus()
    }
    
    override func viewDidLayoutSubviews() {
        self.viewTop.roundCorners(corners: [.topLeft,.topRight], radius: 10.0)
        let width = kScreenWidth - 30
        let columnLayout = ColumnFlowLayout.init(cellsPerRow: 1, minimumInteritemSpacing: 0.0, minimumLineSpacing: 0.0, sectionInset: UIEdgeInsets(top: 0, left: 0, bottom: 0, right: 0), cellHeight: 150, cellWidth: width,scrollDirec: .vertical)
        collectionChalletList?.collectionViewLayout = columnLayout
    }
    //MARK:- SetupUI
    func setupUI() {
        
        self.viewForCalenderContaintView.addCornerForView(cornerRadius: 10.0)
        self.btnSearch.addCorner()
        self.btnSearch.setTitle("Search".localized(), for: .normal)
        self.btnSearch.addBorder()
        self.lblForSelectedChaletInfo.text = topSliderMenuValArray[selectedIndex ?? 0]
        
        let width = kScreenWidth - 30
        let columnLayout = ColumnFlowLayout.init(cellsPerRow: 1, minimumInteritemSpacing: 0.0, minimumLineSpacing: 0.0, sectionInset: UIEdgeInsets(top: 0, left: 0, bottom: 0, right: 0), cellHeight: 150, cellWidth: width,scrollDirec: .vertical)
        collectionChalletList?.collectionViewLayout = columnLayout
        
        let columnLayout1 = ColumnFlowLayout.init(cellsPerRow: 1, minimumInteritemSpacing: 0.0, minimumLineSpacing: 0.0, sectionInset: UIEdgeInsets(top: 0, left: 0, bottom: 0, right: 0), cellHeight: 400, cellWidth: width,scrollDirec: .vertical)
        colletionViewHolidays?.collectionViewLayout = columnLayout1
        self.lblAvailableChalets.text = "Available Chalets".localized()
    }
    
    
    //MARK:- SetupCalanderUI
    lazy var  calenderView: CalenderViewNew = {
        let calenderView = CalenderViewNew.init(theme: MyThemeNew.light, isSelectionEnabled: true)
        calenderView.translatesAutoresizingMaskIntoConstraints=false
        
        return calenderView
    }()
    
    func setupCalenderView() {
        
        calenderContainerView.layer.masksToBounds = true
        calenderContainerView.layer.cornerRadius = 0.0
        calenderContainerView.layer.borderWidth = 0.5
        calenderContainerView.layer.borderColor = UIColor.clear.cgColor
        
        calenderContainerView.addSubview(calenderView)
        calenderView.delegate = self
        calenderView.topAnchor.constraint(equalTo: calenderContainerView.topAnchor, constant: 0).isActive=true
        calenderView.rightAnchor.constraint(equalTo: calenderContainerView.rightAnchor, constant: 0).isActive=true
        calenderView.leftAnchor.constraint(equalTo: calenderContainerView.leftAnchor, constant: 0).isActive=true
        calenderView.heightAnchor.constraint(equalToConstant: 425).isActive=true
        
        //calenderView.bookedSlotDate = [10, 12, 15, 18, 20]
        calenderView.topSelection = self.topSelection
        calenderView.myCollectionView.reloadData()
        if topSelection != "holidays"{
            self.getCalendarList(month: "\(calenderView.currentMonthIndex)", year: "\(calenderView.currentYear)", package: topSelection)
        }
        
        /*if numOfWeeks == 5{
            calenderView.heightAnchor.constraint(equalToConstant: 400).isActive=true
        }else{
            calenderView.heightAnchor.constraint(equalToConstant: calendarHeight).isActive=true
        }*/
        
        
    }
    
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

    //MARK:- Button Actions
    @IBAction func btnSearchAction(_ sender: UIButton) {
        if self.isSearchEnable == true {
            self.searchChalet(fromDate: self.startDate, toDate: self.endDate, selectedPackage: self.topSelection)
            
        }
    }
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        if indexPath.row == 6 {
            if arrayUserDetails.count > 0 {
                return CGFloat(self.arrayUserDetails.count * 150) + 16
            }else{
                return 0
            }
        }else if indexPath.row == 5 {
            if arrayUserDetails.count > 0 {
                return 35
            }else{
                return 0
            }
        }else if indexPath.row == 2 {
            if self.isLoadHolidaysAndEvents == true {
                //return CGFloat(self.arrayChalletList.count * 94)
                
                if self.arrayChalletList.count > 0{
                    
                    let count = self.arrayChalletList.count - 1
                    let arr = self.arrayChalletList.count * 166
                    return CGFloat(arr - 5)
                }else{
                    return 0
                }
                //return CGFloat(arr + 160)
                //return CGFloat(self.arrayChalletList.count * 400)
            }else{
                return 0
            }
            
        }else if indexPath.row == 4 {
            if self.isLoadHolidaysAndEvents == true {
                return 0
            }else{
                return 80
            }
            
        }else if indexPath.row == 3 {
            if self.isLoadHolidaysAndEvents == false {
                
                let numOfWeeks = getNumberOfWeekes(year: calenderView.currentYear, month: calenderView.currentMonthIndex)
                let modelName = UIDevice.modelName

                if numOfWeeks == 5{
                    /*if modelName == "Simulator iPhone 8" || modelName == "iPhone 7" || modelName == "iPhone 6s" || modelName == "iPhone 8" || modelName == "iPhone 11 Pro" || modelName == "Simulator iPhone 11 Pro" || modelName == "Simulator iPhone SE (2nd generation)" || modelName == "iPhone SE (2nd generation)" {
                        return 342
                    }else if modelName == "iPhone 12 Pro Max" || modelName == "Simulator iPhone 12 Pro Max" {
                        return 373
                    }else if modelName == "iPhone 12" || modelName == "Simulator iPhone 12" {
                        return 348
                    }else if modelName == "iPhone 12 mini" || modelName == "Simulator iPhone 12 mini" {
                        return 345
                    }else{
                        return 367
                    }*/
                    if modelName == "Simulator iPhone 8" || modelName == "iPhone 7" || modelName == "iPhone 6s" || modelName == "iPhone 8" || modelName == "iPhone 11 Pro" || modelName == "Simulator iPhone 11 Pro" || modelName == "Simulator iPhone SE (2nd generation)" || modelName == "iPhone SE (2nd generation)" {
                        return 390
                    }else if modelName == "iPhone 12 Pro Max" || modelName == "Simulator iPhone 12 Pro Max" {
                        return 430
                    }else if modelName == "iPhone 12 mini" || modelName == "Simulator iPhone 12 mini" {
                        return 390
                    }else if modelName == "iPhone 12" || modelName == "Simulator iPhone 12" {
                        return 400
                    }else{
                        return 420
                    }
                }else{
                    if modelName == "Simulator iPhone 8" || modelName == "iPhone 7" || modelName == "iPhone 6s" || modelName == "iPhone 8" || modelName == "iPhone 11 Pro" || modelName == "Simulator iPhone 11 Pro" || modelName == "Simulator iPhone SE (2nd generation)" || modelName == "iPhone SE (2nd generation)" {
                        return 390
                    }else if modelName == "iPhone 12 Pro Max" || modelName == "Simulator iPhone 12 Pro Max" {
                        return 430
                    }else if modelName == "iPhone 12 mini" || modelName == "Simulator iPhone 12 mini" {
                        return 390
                    }else if modelName == "iPhone 12" || modelName == "Simulator iPhone 12" {
                        return 400
                    }else{
                        return 420
                    }
                    //return 420
                }
               // return super.tableView(tableView, heightForRowAt: indexPath)
            }else{
                return 0
            }
        }else if indexPath.row == 7 {
            if isNoChaletFound == false {
                return 0
            }else{
                return 65
            }
        }else{
            
            return super.tableView(tableView, heightForRowAt: indexPath)
        }
    }

}
//MARK:- UICollectionViewDelegate, UICollectionViewDataSource
extension SelectPackageTVC : UICollectionViewDelegate, UICollectionViewDataSource, UICollectionViewDelegateFlowLayout {
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        
        if collectionView.tag == 1 {
            return topSliderMenuArray.count
        }else if collectionView.tag == 3{
            return self.arrayChalletList.count
        }else{
            return arrayUserDetails.count
        }
    }
    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        
        if collectionView.tag == 1 {
            let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "SelectChaletMenuCollectionViewCell", for: indexPath) as! SelectChaletMenuCollectionViewCell
            cell.lblTitle.text = topSliderMenuArray[indexPath.item]
            self.collectionView.scrollToItem(at: IndexPath(row: selectedIndex ?? 0, section: 0), at: [.centeredVertically, .centeredHorizontally], animated: true)
            
            if selectedIndex == indexPath.row {
                cell.imgViewBg.image = UIImage(named: "icn_SelectedPackage")
                cell.lblTitle.font = UIFont(name: "Roboto-Bold", size: 17)
            }else{
                cell.imgViewBg.image = UIImage(named: "icn_DeselectedPackage")
                cell.lblTitle.font = UIFont(name: "Roboto-Regular", size: 17)
            }
            cell.isSelected = (selectedIndexPath == indexPath)
            
            return cell
        }else if collectionView.tag == 3{
            let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "CollectionViewHolidaysListCVCell", for: indexPath) as! CollectionViewHolidaysListCVCell
            cell.setupCalenderView()
            let dict = self.arrayChalletList[indexPath.row]
            
            cell.lblEventName.text = dict.event_name!
            cell.lblEventNameNew.text = dict.event_name!
           // cell.lblCheckInDate.text = dict.check_in!
            cell.lblCheckInCheckOutDate.text = "\(dict.check_in!) to \(dict.check_out!)"
            cell.lblCheckOutDateNew.text = dict.check_out!.appFormattedDate
            cell.lblCheckInDateNew.text = dict.check_in!.appFormattedDate
            cell.lblCheckOutTimeNew.text = dict.admincheck_out!
            cell.lblCheckInTimeNew.text = dict.admincheck_in!
            cell.loadView(dictChalet: dict)
            return cell
        }
        else{
            let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "CollectionViewChaletListCVCell", for: indexPath) as! CollectionViewChaletListCVCell
            if self.arrayUserDetails.count > 0 {
                cell.setValuesToFields(dict: self.arrayUserDetails[indexPath.row])
            }
            return cell
        }
    }
    
    func collectionView(_ collectionView: UICollectionView, didSelectItemAt indexPath: IndexPath) {
        
        if collectionView.tag == 1 {
            self.selectedIndex = indexPath.row
            self.lblForSelectedChaletInfo.text = topSliderMenuValArray[indexPath.row]
            self.topSelection = arrayValuesToBackEnd[indexPath.row]
            calenderView.topSelection = self.topSelection
            calenderView.selectedArray.removeAll()
            calenderView.myCollectionView.reloadData()
            DispatchQueue.main.async {
                self.collectionView.reloadData()
                //self.tblView.reloadSections([0], with: .none)
            }
            if topSelection == "holidays"{
                self.isLoadHolidaysAndEvents = true
                self.getHolidayPackage()
                self.tableView.reloadRows(at: [IndexPath(row: 2, section: 0)], with: .none)
                self.tableView.reloadRows(at: [IndexPath(row: 3, section: 0)], with: .none)
               
            }else{
                self.getCalendarList(month: "\(calenderView.currentMonthIndex)", year: "\(calenderView.currentYear)", package: topSelection)
                self.isLoadHolidaysAndEvents = false
                self.tableView.reloadRows(at: [IndexPath(row: 2, section: 0)], with: .none)
                self.tableView.reloadRows(at: [IndexPath(row: 3, section: 0)], with: .none)
            }
            self.isSearchEnable = false
            self.btnSearch.backgroundColor = #colorLiteral(red: 0.6588235294, green: 0.6588235294, blue: 0.6588235294, alpha: 1)
            self.arrayUserDetails.removeAll()
            collectionChalletList.reloadData()
            self.tableView.reloadRows(at: [IndexPath(row: 4, section: 0)], with: .none)
            
        }else if collectionView.tag == 3{
            self.holidaySelectedIndex = indexPath.row
            self.arrayUserDetails.removeAll()
            self.arrayUserDetails = self.arrayChalletList[self.holidaySelectedIndex].user_details!
            self.selectedIndexHolidays = indexPath.row
            DispatchQueue.main.async {
                //self.tableView.reloadRows(at: [IndexPath(row: 2, section: 0)], with: .none)
                self.tableView.reloadRows(at: [IndexPath(row: 5, section: 0)], with: .none)
                self.tableView.reloadRows(at: [IndexPath(row: 6, section: 0)], with: .none)
                self.collectionChalletList.reloadData()
                //self.colletionViewHolidays.reloadData()
                self.tableView.scrollToRow(at: IndexPath(row: 6, section: 0), at: .top, animated: true)
            }
            
        }else {
            if self.arrayUserDetails.count > 0 {
                if self.topSelection != "" {
                    let reservationVC = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(identifier: "ReservationTVC") as! ReservationTVC
                    reservationVC.arrayUserDetails = self.arrayUserDetails
                    reservationVC.selectedIndex = indexPath.item
                    reservationVC.selectedPackage = self.topSelection
                    reservationVC.isFromOffer = false
                    navigationController?.pushViewController(reservationVC, animated: true)
                }
            }
        }
        
    }
    
    
    func collectionView(_ collectionView: UICollectionView, layout collectionViewLayout: UICollectionViewLayout, sizeForItemAt indexPath: IndexPath) -> CGSize {
        if collectionView.tag == 1 {
            if kCurrentLanguageCode == "ar"{
                return CGSize(width: 120 , height: collectionView.bounds.size.height)
            }else{
                return CGSize(width: 110 , height: collectionView.bounds.size.height)
            }
        }else if collectionView.tag == 3{
            return CGSize(width: kScreenWidth , height: 166)
            /*if indexPath.row == selectedIndexHolidays {
                return CGSize(width: kScreenWidth , height: 160)
                
            }else{
                return CGSize(width: kScreenWidth , height: 60)
            }*/
        }else{
            return CGSize(width: kScreenWidth , height: 150)
        }
        
    }
    func collectionView(_ collectionView: UICollectionView, layout collectionViewLayout: UICollectionViewLayout, minimumLineSpacingForSectionAt section: Int) -> CGFloat {
        if collectionView.tag == 1 {
            return 0.4
        }else if collectionView.tag == 3{
            return 0
        }else{
            return 0
        }
        
    }
}
extension SelectPackageTVC : CalenderDelegateNew {
    
    
    
    func didTapDate(day: Int, date: String, available: Bool, selectedDates: [String]) {
        
        self.arrayUserDetails.removeAll()
        self.collectionChalletList.reloadData()
        
        print(selectedDates)
        
        if topSelection == "weekB"{
            if selectedDates.count > 6 {
                self.isSearchEnable = true
                self.btnSearch.backgroundColor = UIColor("#6FDA44")
                self.startDate = convertDateFormat(dateString: selectedDates.first!)
                self.endDate = convertDateFormat(dateString: selectedDates.last!)
                //self.searchChalet(fromDate: convertDateFormat(dateString: selectedDates.first!), toDate: convertDateFormat(dateString: selectedDates.last!), selectedPackage: "weekdays")
            }else{
                self.isSearchEnable = false
                self.btnSearch.backgroundColor = UIColor("#C2C2C2")
                showDefaultAlert(viewController: self, title: "Message".localized(), msg: "Package is not available".localized())
            }
        }else if topSelection == "weekA"{
            if selectedDates.count > 6 {
                self.isSearchEnable = true
                self.btnSearch.backgroundColor = UIColor("#6FDA44")
                self.startDate = convertDateFormat(dateString: selectedDates.first!)
                self.endDate = convertDateFormat(dateString: selectedDates.last!)
                //self.searchChalet(fromDate: convertDateFormat(dateString: selectedDates.first!), toDate: convertDateFormat(dateString: selectedDates.last!), selectedPackage: "weekdays")
            }else{
                self.isSearchEnable = false
                self.btnSearch.backgroundColor = UIColor("#C2C2C2")
                showDefaultAlert(viewController: self, title: "Message".localized(), msg: "Package is not available".localized())
            }
        }else if topSelection == "weekend"{
            if selectedDates.count > 2 {
                self.isSearchEnable = true
                self.btnSearch.backgroundColor = UIColor("#6FDA44")
                self.startDate = convertDateFormat(dateString: selectedDates.first!)
                self.endDate = convertDateFormat(dateString: selectedDates.last!)
                //self.searchChalet(fromDate: convertDateFormat(dateString: selectedDates.first!), toDate: convertDateFormat(dateString: selectedDates.last!), selectedPackage: "weekdays")
            }else{
                self.isSearchEnable = false
                self.btnSearch.backgroundColor = UIColor("#C2C2C2")
                showDefaultAlert(viewController: self, title: "Message".localized(), msg: "Package is not available".localized())
            }
        }else if topSelection == "weekdays"{
            if selectedDates.count > 3 {
                self.isSearchEnable = true
                self.btnSearch.backgroundColor = UIColor("#6FDA44")
                self.startDate = convertDateFormat(dateString: selectedDates.first!)
                self.endDate = convertDateFormat(dateString: selectedDates.last!)
                //self.searchChalet(fromDate: convertDateFormat(dateString: selectedDates.first!), toDate: convertDateFormat(dateString: selectedDates.last!), selectedPackage: "weekdays")
            }else{
                self.isSearchEnable = false
                self.btnSearch.backgroundColor = UIColor("#C2C2C2")
                showDefaultAlert(viewController: self, title: "Message".localized(), msg: "Package is not available".localized())
            }
        }
        
        /*if selectedDates.count > 1 {
            self.isSearchEnable = true
            self.btnSearch.backgroundColor = #colorLiteral(red: 0.002171910696, green: 0.6666592845, blue: 0.007707458573, alpha: 1)
            self.startDate = convertDateFormat(dateString: selectedDates.first!)
            self.endDate = convertDateFormat(dateString: selectedDates.last!)
            //self.searchChalet(fromDate: convertDateFormat(dateString: selectedDates.first!), toDate: convertDateFormat(dateString: selectedDates.last!), selectedPackage: "weekdays")
        }else{
            self.isSearchEnable = false
            self.btnSearch.backgroundColor = #colorLiteral(red: 0.6588235294, green: 0.6588235294, blue: 0.6588235294, alpha: 1)
        }*/
    }
    
    func noChaletAvailable() {
        //self.isSearchEnable = false
        //self.btnSearch.backgroundColor = UIColor("#C2C2C2")
        showDefaultAlert(viewController: self, title: "Message".localized(), msg: "Package is not available".localized())
    }
    
    func didChangeMonth(monthIndex: Int, year: Int) {
        //print(monthIndex)
        //print(year)
        
        self.getCalendarList(month: "\(monthIndex)", year: "\(year)", package: topSelection)
        self.tableView.reloadRows(at: [IndexPath(row: 3, section: 0)], with: .none)
    }
    
    func delegateChaletReserved() {
        showDefaultAlert(viewController: self, title: "Message".localized(), msg: "All the chalets are booked for this period".localized())
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
extension SelectPackageTVC {
    
    //MARK:- Search Chalet
    func searchChalet(fromDate:String,toDate:String,selectedPackage:String) {
        ServiceManager.sharedInstance.postMethodAlamofire("api/searchchalet", dictionary: ["from_date":fromDate,"to_date":toDate,"package":selectedPackage,"userid":CAUser.currentUser.id != nil ? CAUser.currentUser.id! : 0], withHud: true) { (success, response, error) in
            self.arrayUserDetails.removeAll()
            if success {
                if response!["status"] as! Bool == true {
                    let responseBase = ChaletSearchBase(dictionary: response as! NSDictionary)
                    self.arrayUserDetails = (responseBase?.user_details)!
                    
                    DispatchQueue.main.async {
                        self.tableView.reloadRows(at: [IndexPath(row: 5, section: 0)], with: .none)
                        self.tableView.reloadRows(at: [IndexPath(row: 6, section: 0)], with: .none)
                        self.collectionChalletList.reloadData()
                        if self.arrayUserDetails.count > 0{
                            self.tableView.scrollToRow(at: IndexPath(row: 5, section: 0), at: .top, animated: true)
                        }
                    }
                }else{
                    DispatchQueue.main.async {
                        self.isNoChaletFound = true
                        self.tableView.reloadRows(at: [IndexPath(row: 7, section: 0)], with: .none)
                        self.tableView.reloadRows(at: [IndexPath(row: 6, section: 0)], with: .none)
                        self.tableView.reloadRows(at: [IndexPath(row: 5, section: 0)], with: .none)
                    }
                }
            }else{
                showDefaultAlert(viewController: self, title: "", msg: response!["message"] as! String)
            }
        }
    }
    //MARK:- Convert Dateformat
    func convertDateFormat(dateString:String) -> String {
        let dateFormatter = DateFormatter()
        dateFormatter.dateFormat = "dd/MM/yyyy"
        let dat = dateFormatter.date(from: dateString)
        dateFormatter.dateFormat = "yyyy-MM-dd"
        return dateFormatter.string(from: dat!)
    }
}
extension SelectPackageTVC {
    
    func getCalendarList(month:String,year:String,package:String) {
        let dateFormatter = DateFormatter()
        dateFormatter.dateFormat = "M"
        let formattedMonth = dateFormatter.date(from: month)
        dateFormatter.dateFormat = "MM"
        let mont = dateFormatter.string(from: formattedMonth!)
        
        ServiceManager.sharedInstance.postMethodAlamofire("api/calendarlist", dictionary: ["month":mont,"year":year,"package":package], withHud: true) { (success, response, error) in
            self.arrayUserDetails.removeAll()
            if success {
                if response!["status"] as! Bool == true {
                    let responseBase = CalendarListBase(dictionary: response as! NSDictionary)
                    self.arrayCalendarList = (responseBase?.calendarData)!
                    self.arrayListCalender.removeAll()
                    for dict in self.arrayCalendarList {
                        if dict.available_status == true {
                            let dateFormatter = DateFormatter()
                            var jobDatesBetweenArray = [String]()
                            jobDatesBetweenArray = self.betWeenDates(fromDate: dict.start_date!, toDate: dict.end_date!)
                            for jobDatesF in jobDatesBetweenArray {
                                dateFormatter.dateFormat = "yyyy-MM-dd"
                                let dateJob = dateFormatter.date(from: jobDatesF)
                                dateFormatter.dateFormat = "yyyy"
                                let year: String = dateFormatter.string(from: dateJob!)
                                dateFormatter.dateFormat = "MM"
                                let month: String = dateFormatter.string(from: dateJob!)
                                dateFormatter.dateFormat = "dd"
                                let day: String = dateFormatter.string(from: dateJob!)
                                let jobDictPerDate = JobsPerDate(Int(day)!, jobMonth: Int(month)!, jobYear: Int(year)!, jobCount: Int(day)!, jobFormatYear: jobDatesF, jobID: "")
                                self.arrayListCalender.append(jobDictPerDate)
                            }
                        }
                    }
                    self.calenderView.arrayListToCalender = self.arrayListCalender
                    self.calenderView.reload()
                }else{
                    
                }
            }else{
                showDefaultAlert(viewController: self, title: "", msg: "Failed..!")
            }
        }
    }
    
    func betWeenDates(fromDate:String,toDate:String) -> [String] {
        var mydates : [String] = []
        let startDate = fromDate
        let endDate   = toDate
        var dateFrom =  Date()
        var dateTo = Date()
        let fmt = DateFormatter()
        fmt.dateFormat = "yyyy-MM-dd"
        dateFrom = fmt.date(from: startDate)!
        dateTo = fmt.date(from: endDate)!
        while dateFrom <= dateTo {
            mydates.append(fmt.string(from: dateFrom))
            dateFrom = Calendar.current.date(byAdding: .day, value: 1, to: dateFrom)!
        }
        return mydates
    }
    
    func numberOfWeeksInMonth(_ date: Date) -> Int {
         var calendar = Calendar(identifier: .gregorian)
         calendar.firstWeekday = 1
         let weekRange = calendar.range(of: .weekOfMonth,
                                        in: .month,
                                        for: date)
         return weekRange!.count
    }
    
    func getNumberOfWeekes(year:Int,month:Int) -> Int {
        let dateComponents = DateComponents.init(year: year, month: month)
        let monthCurrentDayFirst = Calendar.current.date(from: dateComponents)!
        let monthNextDayFirst = Calendar.current.date(byAdding: .month, value: 1, to: monthCurrentDayFirst)!
        let monthCurrentDayLast = Calendar.current.date(byAdding: .day, value: -1, to: monthNextDayFirst)!
        return Calendar.current.component(.weekOfMonth, from: monthCurrentDayLast)
    }
}
extension SelectPackageTVC {
    
    //MARK:- Get Holidays Package
    func getHolidayPackage() {
        self.arrayChalletList.removeAll()
        ServiceManager.sharedInstance.postMethodAlamofire("api/holidaysevents", dictionary: nil, withHud: true) { (success, response, error) in
            self.arrayUserDetails.removeAll()
            if success {
                if response!["status"] as! Bool == true {
                    let responseBase = HolidaysAndEventsBas(dictionary: response as! NSDictionary)
                    self.arrayChalletList = (responseBase?.chalet_list)!
                    DispatchQueue.main.async {
                        self.tableView.reloadRows(at: [IndexPath(row: 2, section: 0)], with: .bottom)
                        self.colletionViewHolidays.reloadData()
                        self.isSearchEnable = false
                        self.btnSearch.backgroundColor = #colorLiteral(red: 0.6588235294, green: 0.6588235294, blue: 0.6588235294, alpha: 1)
                    }
                }else{
                    showDefaultAlert(viewController: self, title: "", msg: "Something went wrong..!")
                }
            }else{
                showDefaultAlert(viewController: self, title: "", msg: "Failed..!")
            }
        }
    }
    
    
}

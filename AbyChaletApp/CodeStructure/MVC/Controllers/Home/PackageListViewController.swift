//
//  HomeViewController.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 28/04/21.
//

import UIKit

struct PackageBookingChartStruct {
    var type:String
    var days:String
}

class PackageListViewController: UIViewController {
    @IBOutlet weak var tblView: UITableView!
    
    lazy var packageBookingChartArray: [PackageBookingChartStruct] = [
        PackageBookingChartStruct(type: "Weekdays".localized(), days: "Sunday - Monday - Tuesday - Wednesday".localized()),
        PackageBookingChartStruct(type: "Weekend".localized(), days: "Thursday - Friday - Saturday".localized()),
        PackageBookingChartStruct(type: "Week (A)".localized(), days: "Sunday to Saturday".localized()),
        PackageBookingChartStruct(type: "Week (B)".localized(), days: "Thursday to Wednesday".localized()),
        PackageBookingChartStruct(type: "Holidays and Events".localized(), days: "Prices vary in these periods".localized())
    ]
    
    override func viewDidLoad() {
        super.viewDidLoad()
        setupForCustomNavigationTitle(self: self)
        navigationController?.navigationBar.barTintColor = kAppHeaderColor
        navigationController?.navigationBar.isTranslucent = false
        NotificationCenter.default.addObserver(self, selector: #selector(logoutUser), name: NSNotification.Name(rawValue: NotificationNames.kBlockedUser), object: nil)
    }
    
    override func viewWillAppear(_ animated: Bool) {
        appDelegate.checkBlockStatus()
    }
    
    @objc func logoutUser() {
        appDelegate.logOut()
    }
 
}
 //MARK:- UITableViewDelegate & DataSource

extension PackageListViewController: UITableViewDelegate, UITableViewDataSource {
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return packageBookingChartArray.count
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let cell = tblView.dequeueReusableCell(withIdentifier: "PackageListTableVCell", for: indexPath) as! PackageListTableVCell
        cell.packageListData = packageBookingChartArray[indexPath.row]
        return cell
    }
    func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        return screenHeight / 6.9
    }
    
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        //let nextVC = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(identifier: "SelectPackageVC") as! SelectPackageVC
        
        let nextVC = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(identifier: "SelectPackageTVC") as! SelectPackageTVC
        
        if indexPath.row == 0 {
            nextVC.selectedIndex = 4
        }else if indexPath.row == 1 {
            nextVC.selectedIndex = 3

        }else if indexPath.row == 2 {
            nextVC.selectedIndex = 2

        }else if indexPath.row == 3 {
            nextVC.selectedIndex = 1

        }else if indexPath.row == 4 {
            nextVC.selectedIndex = 0

        }


        navigationController?.pushViewController(nextVC, animated: true)
    }
    
}

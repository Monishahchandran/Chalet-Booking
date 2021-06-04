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
        PackageBookingChartStruct(type: "Weekdays", days: "Sunday - Monday - Tuesday - Wednesday"),
        PackageBookingChartStruct(type: "Weekend", days: "Thursday - Friday - Saturday"),
        PackageBookingChartStruct(type: "Week (A)", days: "Sunday to Saturday"),
        PackageBookingChartStruct(type: "Week (B)", days: "Thursday to Wednesday"),
        PackageBookingChartStruct(type: "Holidays and Events", days: "Prices vary in these periods")
    ]
    
    override func viewDidLoad() {
        super.viewDidLoad()
        setupForCustomNavigationTitle(self: self)
        navigationController?.navigationBar.barTintColor = kAppHeaderColor
        navigationController?.navigationBar.isTranslucent = false

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

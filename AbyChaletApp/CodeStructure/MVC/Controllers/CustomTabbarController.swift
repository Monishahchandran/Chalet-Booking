//
//  CustomTabbarController.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 28/04/21.
//

import UIKit

class CustomTabbarController: UITabBarController {

    
    
    let image = UIImage(named: "icn_profile")
    let selectedImage = UIImage(named: "icn_SelectedProfile")
    let selectedImageLogin = UIImage(named: "icn_profile")
    override func viewDidLoad() {
        super.viewDidLoad()

        let packageListVC = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(identifier: "PackageListViewController") as! PackageListViewController
        let item1 = UINavigationController(rootViewController: packageListVC)
        self.viewControllers![0] = item1
        self.tabBar.items![0].title = "Home"
        self.tabBar.items![0].image = UIImage(named: "icn_Home")?.withRenderingMode(.alwaysOriginal).withTintColor(.lightGray)
        self.tabBar.isTranslucent = false
        
    }
    
    override func viewWillAppear(_ animated: Bool) {
        
        /*let packageListVC = UIStoryboard(name: "Main", bundle: Bundle.main).instantiateViewController(identifier: "PackageListViewController") as! PackageListViewController
        let item1 = UINavigationController(rootViewController: packageListVC)
        self.viewControllers![0] = item1
        self.tabBar.items![0].title = "Home"
        self.tabBar.items![0].image = UIImage(named: "icn_Home")?.withRenderingMode(.alwaysOriginal).withTintColor(.lightGray)*/
        
        
        
        
        if (UserDefaults.standard.object(forKey: "kCurrentUserDetails") != nil) {
            let profileVC = UIStoryboard(name: "ProfileNew", bundle: Bundle.main).instantiateViewController(identifier: "MyProfileContainerVC") as! MyProfileContainerVC
            let item4 = UINavigationController(rootViewController: profileVC)
            self.viewControllers![3] = item4
            self.tabBar.items![3].title = "Profile"
            self.tabBar.items![3].image = image
        }
    }

    override func tabBar(_ tabBar: UITabBar, didSelect item: UITabBarItem) {
        
        if(item.title! == "Profile"){
            if (UserDefaults.standard.object(forKey: "kCurrentUserDetails") != nil) {
                item.selectedImage = selectedImage!.withRenderingMode(.alwaysOriginal)
            }else{
                item.selectedImage = selectedImageLogin!.withRenderingMode(.alwaysOriginal)
                
            }
        }else if(item.title! == "Home"){
            item.selectedImage = UIImage(named: "icn_Home")?.withRenderingMode(.alwaysOriginal).withTintColor(.white)
        }
    }

}

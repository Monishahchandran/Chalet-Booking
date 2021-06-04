//
//  AppDelegate.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 23/04/21.
//

import UIKit
import IQKeyboardManagerSwift
import MFSDK
import SDWebImage
import UserNotifications
import AVFoundation
import GoogleMaps
@main
class AppDelegate: UIResponder, UIApplicationDelegate {
    var window: UIWindow?

    func application(_ application: UIApplication, didFinishLaunchingWithOptions launchOptions: [UIApplication.LaunchOptionsKey: Any]?) -> Bool {
        //printFontName()
        extendSplashScreenPresentation()
        IQKeyboardManager.shared.enable = true
        self.checkAutoLogin()
        self.enableNotification()
        let token = "rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL"
        let url = "https://apitest.myfatoorah.com/"
        MFSettings.shared.configure(token: token, baseURL: url)
        let them = MFTheme(navigationTintColor: #colorLiteral(red: 1, green: 1, blue: 1, alpha: 1), navigationBarTintColor: kAppThemeColor, navigationTitle: "Payment", cancelButtonTitle: "Cancel")
        MFSettings.shared.setTheme(theme: them)
        GMSServices.provideAPIKey("AIzaSyB75kZV00quV-LeAWJD9QaZ8Hbc4kqBgwo")
        return true
    }
    
    func printFontName(){
        for family in UIFont.familyNames {
            print("\(family)")

            for name in UIFont.fontNames(forFamilyName: family) {
                print("\(name)")
            }
        }
    }

    func settingFirstViewController(){
        let appDelegate = UIApplication.shared.delegate as! AppDelegate
        let currentAppLaunchCount = UserDefaults.standard.integer(forKey: "appLaunchCount")
        if currentAppLaunchCount == 0 {
            let storyboard = UIStoryboard.init(name: "Main", bundle: nil)
            let introScreen = storyboard.instantiateViewController(withIdentifier: "IntroScreenVC") as! IntroScreenVC
            appDelegate.window?.rootViewController = introScreen
            
        }else {
            redirectingToHomeScreen()

        }
        window?.makeKeyAndVisible()
        
        UserDefaults.standard.set(currentAppLaunchCount + 1 , forKey: "appLaunchCount")
        UserDefaults.standard.synchronize()
    }
    
    func extendSplashScreenPresentation(){
        // Get a refernce to LaunchScreen.storyboard
        let launchStoryBoard = UIStoryboard.init(name: "LaunchScreen", bundle: nil)
        // Get the splash screen controller
        let splashController = launchStoryBoard.instantiateViewController(withIdentifier: "splashController")
        // Assign it to rootViewController
        self.window?.rootViewController = splashController
        self.window?.makeKeyAndVisible()
        // Setup a timer to remove it after n seconds
        Timer.scheduledTimer(timeInterval: 3, target: self, selector: #selector(dismissSplashController), userInfo: nil, repeats: false)
    }
    
    @objc private func dismissSplashController() {
        settingFirstViewController()
    }
}
extension AppDelegate {
    
    func checkAutoLogin()  {
        
        if (UserDefaults.standard.object(forKey: "kCurrentUserDetails") != nil) {
            let dict:NSDictionary = NSKeyedUnarchiver.unarchiveObject(with: (UserDefaults.standard.object(forKey: "kCurrentUserDetails") as! NSData) as Data) as! NSDictionary
            CAUser.currentUser.initWithDictionary(userDictionary: dict)
            CAUser.saveLoggedUserdetails(dictDetails: dict)
            
        }else {
            
            
        }
    }
    
    func logOut()  {
        UserDefaults.standard.removeObject(forKey: "kCurrentUserDetails")
        CAUser.currentUser.id = nil
        SDImageCache.shared.clearMemory()
        SDImageCache.shared.clearDisk()
        let storyboard = UIStoryboard.init(name: "Main", bundle: nil)
        let loginScreen = storyboard.instantiateViewController(withIdentifier: "CustomTabbarController") as! CustomTabbarController
        UIView.transition(with: window!, duration: 0.3, options: .transitionCrossDissolve, animations: {
            self.window?.rootViewController = loginScreen
        }, completion: { completed in
            loginScreen.selectedIndex = 3
            appDelegate.window?.rootViewController = loginScreen
        })
    }
    
    
}
extension AppDelegate : UNUserNotificationCenterDelegate {
    
    
    /* Notifications */
    func enableNotification() {
        UIApplication.shared.applicationIconBadgeNumber = 0
        if #available(iOS 10.0, *) {
            let center  = UNUserNotificationCenter.current()
            center.delegate = self
            center.requestAuthorization(options: [.sound, .alert, .badge]) { (granted, error) in
                if error == nil {
                    DispatchQueue.main.async(execute: {
                        UIApplication.shared.registerForRemoteNotifications()
                    })
                }
            }
        }else {
            let settings = UIUserNotificationSettings(types: [.sound, .alert, .badge], categories: nil)
            UIApplication.shared.registerUserNotificationSettings(settings)
            UIApplication.shared.registerForRemoteNotifications()
        }
    }
    
    func disableNotification() {
        UIApplication.shared.unregisterForRemoteNotifications()
    }
    
    
    func application(_ application: UIApplication, didRegisterForRemoteNotificationsWithDeviceToken deviceToken: Data) {
        let deviceToken = deviceToken.map { String(format: "%02.2hhx", $0) }.joined()
        UserDefaults.standard.set(deviceToken, forKey: "kDeviceToken")
        UserDefaults.standard.synchronize()
        
    }
    
    func application(_ application: UIApplication, didFailToRegisterForRemoteNotificationsWithError error: Error) {
        print(error)
    }
    
    func application(_ application: UIApplication, didReceiveRemoteNotification userInfo: [AnyHashable : Any], fetchCompletionHandler completionHandler: @escaping (UIBackgroundFetchResult) -> Void) {
        
        let state: UIApplication.State = UIApplication.shared.applicationState
        if state == .active {
            let systemSoundID: SystemSoundID = 1007
           // AudioServicesPlaySystemSound(systemSoundID)
        }
        
    }
    func userNotificationCenter(_ center: UNUserNotificationCenter, willPresent notification: UNNotification, withCompletionHandler completionHandler: @escaping (UNNotificationPresentationOptions) -> Void){
        
        completionHandler([.alert, .badge, .sound])
        
    }
    
}

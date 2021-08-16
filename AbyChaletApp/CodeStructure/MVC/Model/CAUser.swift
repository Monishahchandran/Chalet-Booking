//
//  CAUser.swift
//
//  Created by Visakh Srishti on 04/05/21.
//  Copyright © 2021 Visakh M P. All rights reserved.
//

import Foundation

class CAUser: NSObject {
    
    static var currentUser = CAUser()
    
    var id              : Int?
    var first_name      : String?
    var last_name       : String?
    var email           : String?
    var password        : String?
    var dob             : String?
    var gender          : String?
    var phone          : String?
    var created_at      : String?
    var updated_at      : String?
    var device_token    : String?
    var country         : String?
    var email_verification  : Bool?
    var phone_verification  : Bool?
    var userstatus         : String?
    var country_code         : String?
    var profile_pic         : String?
    
    
    func initWithDictionary(userDictionary : NSDictionary)   {
        id      = userDictionary.value(forKey: "id")    != nil ? userDictionary.value(forKey:"id")! as! Int          : 0
        first_name   = userDictionary.value(forKey: "first_name")   != nil ? userDictionary.value(forKey:"first_name")! as! String  : ""
        last_name   = userDictionary.value(forKey: "last_name")   != nil ? userDictionary.value(forKey:"last_name")! as! String  : ""
        last_name   = userDictionary.value(forKey: "last_name")   != nil ? userDictionary.value(forKey:"last_name")! as! String  : ""
        email   = userDictionary.value(forKey: "email")   != nil ? userDictionary.value(forKey:"email")! as! String  : ""
        password   = userDictionary.value(forKey: "password")   != nil ? userDictionary.value(forKey:"password")! as! String  : ""
        dob   = userDictionary.value(forKey: "dob")   != nil ? userDictionary.value(forKey:"dob")! as! String  : ""
        gender   = userDictionary.value(forKey: "gender")   != nil ? userDictionary.value(forKey:"gender")! as! String  : ""
        phone   = userDictionary.value(forKey: "phone")   != nil ? userDictionary.value(forKey:"phone")! as! String  : ""
        created_at   = userDictionary.value(forKey: "created_at")   != nil ? userDictionary.value(forKey:"created_at")! as! String  : ""
        updated_at   = userDictionary.value(forKey: "updated_at")   != nil ? userDictionary.value(forKey:"updated_at")! as! String  : ""
        device_token   = userDictionary.value(forKey: "device_token")   != nil ? userDictionary.value(forKey:"device_token")! as! String  : ""
        country   = userDictionary.value(forKey: "country")   != nil ? userDictionary.value(forKey:"country")! as! String  : ""
        country_code   = userDictionary.value(forKey: "country_code")   != nil ? userDictionary.value(forKey:"country_code")! as! String  : ""
        profile_pic   = userDictionary.value(forKey: "profile_pic")   != nil ? userDictionary.value(forKey:"profile_pic")! as! String  : ""
        userstatus   = userDictionary.value(forKey: "userstatus")   != nil ? userDictionary.value(forKey:"userstatus")! as! String  : ""
        email_verification   = userDictionary.value(forKey: "email_verification")   != nil ? userDictionary.value(forKey:"email_verification")! as! Bool  : false
        phone_verification   = userDictionary.value(forKey: "phone_verification")   != nil ? userDictionary.value(forKey:"phone_verification")! as! Bool  : false
    }
    
    class func logOutCurrentUser(){
        let appDomain = Bundle.main.bundleIdentifier!
        UserDefaults.standard.removePersistentDomain(forName: appDomain)
    }
    //MARK:- STORE USER DATA
    public class func saveLoggedUserdetails(dictDetails : NSDictionary){
        let data : NSData = NSKeyedArchiver.archivedData(withRootObject: dictDetails) as NSData
        UserDefaults.standard.set(data, forKey: "kCurrentUserDetails")
        UserDefaults.standard.synchronize()
    }
    
}
class CAGuestUser: NSObject {
    
    static var currentUser = CAGuestUser()
    
    var id              : Int?
    var first_name      : String?
    var last_name       : String?
    var email           : String?
    var password        : String?
    var dob             : String?
    var gender          : String?
    var phone          : String?
    var created_at      : String?
    var updated_at      : String?
    var device_token    : String?
    var country         : String?
    var email_verification  : Bool?
    var phone_verification  : Bool?
    var userstatus          : String?
    var country_code        : String?
    var profile_pic         : String?
    
    
    func initWithDictionary(userDictionary : NSDictionary)   {
        id      = userDictionary.value(forKey: "id")    != nil ? userDictionary.value(forKey:"id")! as! Int          : 0
        first_name   = userDictionary.value(forKey: "first_name")   != nil ? userDictionary.value(forKey:"first_name")! as! String  : ""
        last_name   = userDictionary.value(forKey: "last_name")   != nil ? userDictionary.value(forKey:"last_name")! as! String  : ""
        last_name   = userDictionary.value(forKey: "last_name")   != nil ? userDictionary.value(forKey:"last_name")! as! String  : ""
        email   = userDictionary.value(forKey: "email")   != nil ? userDictionary.value(forKey:"email")! as! String  : ""
        password   = userDictionary.value(forKey: "password")   != nil ? userDictionary.value(forKey:"password")! as! String  : ""
        dob   = userDictionary.value(forKey: "dob")   != nil ? userDictionary.value(forKey:"dob")! as! String  : ""
        gender   = userDictionary.value(forKey: "gender")   != nil ? userDictionary.value(forKey:"gender")! as! String  : ""
        phone   = userDictionary.value(forKey: "phone")   != nil ? userDictionary.value(forKey:"phone")! as! String  : ""
        created_at   = userDictionary.value(forKey: "created_at")   != nil ? userDictionary.value(forKey:"created_at")! as! String  : ""
        updated_at   = userDictionary.value(forKey: "updated_at")   != nil ? userDictionary.value(forKey:"updated_at")! as! String  : ""
        device_token   = userDictionary.value(forKey: "device_token")   != nil ? userDictionary.value(forKey:"device_token")! as! String  : ""
        country   = userDictionary.value(forKey: "country")   != nil ? userDictionary.value(forKey:"country")! as! String  : ""
        country_code   = userDictionary.value(forKey: "country_code")   != nil ? userDictionary.value(forKey:"country_code")! as! String  : ""
        profile_pic   = userDictionary.value(forKey: "profile_pic")   != nil ? userDictionary.value(forKey:"profile_pic")! as! String  : ""
        userstatus   = userDictionary.value(forKey: "userstatus")   != nil ? userDictionary.value(forKey:"userstatus")! as! String  : ""
        email_verification   = userDictionary.value(forKey: "email_verification")   != nil ? userDictionary.value(forKey:"email_verification")! as! Bool  : false
        phone_verification   = userDictionary.value(forKey: "phone_verification")   != nil ? userDictionary.value(forKey:"phone_verification")! as! Bool  : false
    }
    
    class func logOutCurrentGuest(){
        let appDomain = Bundle.main.bundleIdentifier!
        UserDefaults.standard.removePersistentDomain(forName: appDomain)
    }
    //MARK:- STORE USER DATA
    public class func saveLoggedGuestdetails(dictDetails : NSDictionary){
        let data : NSData = NSKeyedArchiver.archivedData(withRootObject: dictDetails) as NSData
        UserDefaults.standard.set(data, forKey: "kCurrentGuestUserDetails")
        UserDefaults.standard.synchronize()
    }
    
}

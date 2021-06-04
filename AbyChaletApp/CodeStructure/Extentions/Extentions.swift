//
//  Extentions.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 26/04/21.
//

import Foundation
import UIKit

public enum UIColorInputError : Error {
    case missingHashMarkAsPrefix,
    unableToScanHexValue,
    mismatchedHexStringLength
}

extension UIView {

    func dropShadow(scale: Bool = true) {
        layer.masksToBounds = true
        layer.shadowColor = UIColor.lightGray.cgColor
        layer.shadowOpacity = 0.8
        layer.shadowOffset = CGSize(width: 0, height: 5)
        layer.shadowRadius = 2
        layer.borderWidth = 1
        layer.shouldRasterize = true
        layer.rasterizationScale = scale ? UIScreen.main.scale : 1
        layer.borderColor =  UIColor(red:222/255, green:225/255, blue:227/255, alpha: 1).cgColor
        layer.shadowPath = UIBezierPath(roundedRect: bounds, cornerRadius: 5).cgPath
   }

    func addBottomRoundedEdge() {
        let offset: CGFloat = (self.frame.width * 1.5)
        let bounds: CGRect = self.bounds

        let rectBounds: CGRect = CGRect(x: bounds.origin.x, y: bounds.origin.y, width: bounds.size.width , height: bounds.size.height / 2)
        let rectPath: UIBezierPath = UIBezierPath(rect: rectBounds)
        let ovalBounds: CGRect = CGRect(x: bounds.origin.x - offset / 2, y: bounds.origin.y, width: bounds.size.width + offset , height: bounds.size.height)
        let ovalPath: UIBezierPath = UIBezierPath(ovalIn: ovalBounds)
        rectPath.append(ovalPath)

        let maskLayer: CAShapeLayer = CAShapeLayer()
        maskLayer.frame = bounds
        maskLayer.path = rectPath.cgPath

        self.layer.mask = maskLayer
    }
    func addCornerForView(cornerRadius:CGFloat? = nil){
        self.layer.cornerRadius = cornerRadius ?? (self.bounds.size.height)/2
        self.clipsToBounds = true
    }
    func addCornerForDatePicker(){
        self.layer.cornerRadius = 10
        self.clipsToBounds = true
    }
    func removeCornerForView(){
        self.layer.cornerRadius = 0
        self.clipsToBounds = true
    }
    func addBorderForView(){
        self.layer.borderWidth = 2
        self.layer.borderColor = UIColor.white.cgColor
    }
    func addBorderForDatePicker(){
        self.layer.borderWidth = 2
        self.layer.borderColor = UIColor.systemBlue.cgColor
    }
    func addShadowForView(){
        self.layer.shadowColor = UIColor.lightGray.cgColor
        self.layer.shadowRadius = 5
        self.layer.shadowOpacity = 0.7
        self.layer.shadowOffset = .zero
        self.layer.masksToBounds = false
    }

}
extension UIButton {
    func addCorner(){
        self.layer.cornerRadius = self.bounds.size.height/2
        self.clipsToBounds = true
    }
    func addBorder(){
        self.layer.borderWidth = 2
        self.layer.borderColor = UIColor.white.cgColor
    }
    
    func addShadow(){
        self.layer.shadowColor = UIColor.lightGray.cgColor
        self.layer.shadowRadius = 5
        self.layer.shadowOpacity = 0.7
        self.layer.shadowOffset = .zero
        self.layer.masksToBounds = false
    }
}


extension NSLayoutConstraint {
    func setMultiplier(multiplier: CGFloat) -> NSLayoutConstraint {
        guard let firstItem = firstItem else {
            return self
        }
        NSLayoutConstraint.deactivate([self])
        let newConstraint = NSLayoutConstraint(item: firstItem, attribute: firstAttribute, relatedBy: relation, toItem: secondItem, attribute: secondAttribute, multiplier: multiplier, constant: constant)
        newConstraint.priority = priority
        newConstraint.shouldBeArchived = self.shouldBeArchived
        newConstraint.identifier = self.identifier
        NSLayoutConstraint.activate([newConstraint])
        return newConstraint
    }
}
extension UIViewController {
    
    //MARK:- EMAIL VALIDATION
    func isValidEmail(_ email: String) -> Bool
    {
        let stricterFilterString:NSString = "[A-Z0-9a-z\\._%+-]+@([A-Za-z0-9-]+\\.)+[A-Za-z]{2,4}"
        let emailRegex:NSString = stricterFilterString
        let emailTest:NSPredicate = NSPredicate(format: "SELF MATCHES %@", emailRegex)
        return emailTest.evaluate(with: email)
    }
    
}


extension UITextField {
    func setLeftPaddingPoints(_ amount:CGFloat){
        let paddingView = UIView(frame: CGRect(x: 0, y: 0, width: amount, height: self.frame.size.height))
        self.leftView = paddingView
        self.leftViewMode = .always
    }
    func setRightPaddingPoints(_ amount:CGFloat) {
        let paddingView = UIView(frame: CGRect(x: 0, y: 0, width: amount, height: self.frame.size.height))
        self.rightView = paddingView
        self.rightViewMode = .always
    }
}
extension UIView
{
    func roundCorners(corners:UIRectCorner, radius: CGFloat)
    {
        let maskLayer = CAShapeLayer()
        maskLayer.path = UIBezierPath(roundedRect: self.bounds, byRoundingCorners: corners, cornerRadii: CGSize(width: radius, height: radius)).cgPath
        self.layer.mask = maskLayer
    }
}
extension UIImage {
    static func gradientImageWithBounds(bounds: CGRect, colors: [CGColor]) -> UIImage {
        let gradientLayer = CAGradientLayer()
        gradientLayer.frame = bounds
        gradientLayer.colors = colors

        UIGraphicsBeginImageContext(gradientLayer.bounds.size)
        gradientLayer.render(in: UIGraphicsGetCurrentContext()!)
        let image = UIGraphicsGetImageFromCurrentImageContext()
        UIGraphicsEndImageContext()
        return image!
    }
}
extension Date {
    /// Returns the amount of years from another date
    func years(from date: Date) -> Int {
        return Calendar.current.dateComponents([.year], from: date, to: self).year ?? 0
    }
    /// Returns the amount of months from another date
    func months(from date: Date) -> Int {
        return Calendar.current.dateComponents([.month], from: date, to: self).month ?? 0
    }
    /// Returns the amount of weeks from another date
    func weeks(from date: Date) -> Int {
        return Calendar.current.dateComponents([.weekOfMonth], from: date, to: self).weekOfMonth ?? 0
    }
    /// Returns the amount of days from another date
    func days(from date: Date) -> Int {
        return Calendar.current.dateComponents([.day], from: date, to: self).day ?? 0
    }
    /// Returns the amount of hours from another date
    func hours(from date: Date) -> Int {
        return Calendar.current.dateComponents([.hour], from: date, to: self).hour ?? 0
    }
    /// Returns the amount of minutes from another date
    func minutes(from date: Date) -> Int {
        return Calendar.current.dateComponents([.minute], from: date, to: self).minute ?? 0
    }
    /// Returns the amount of seconds from another date
    func seconds(from date: Date) -> Int {
        return Calendar.current.dateComponents([.second], from: date, to: self).second ?? 0
    }
    /// Returns the a custom time interval description from another date
    func offset(from date: Date) -> String {
        if years(from: date)   > 0 { return "\(years(from: date))y"   }
        if months(from: date)  > 0 { return "\(months(from: date))M"  }
        if weeks(from: date)   > 0 { return "\(weeks(from: date))w"   }
        if days(from: date)    > 0 { return "\(days(from: date))d"    }
        if hours(from: date)   > 0 { return "\(hours(from: date))h"   }
        if minutes(from: date) > 0 { return "\(minutes(from: date))m" }
        if seconds(from: date) > 0 { return "\(seconds(from: date))s" }
        return ""
    }
}
extension String {
    
    func color() -> UIColor? {
        switch(self){
        case "lightGray":
            return UIColor.lightGray
        case "gray":
            return UIColor.gray
        case "darkGray":
            return UIColor.darkGray
        case "black":
            return UIColor.black
        case "red":
            return UIColor.red
        case "green":
            return UIColor.green
        case "blue":
            return UIColor.blue
        case "cyan":
            return UIColor.cyan
        case "yellow":
            return UIColor.yellow
        case "magenta":
            return UIColor.magenta
        case "orange":
            return UIColor.orange
        case "purple":
            return UIColor.purple
        case "brown":
            return UIColor.brown
        default:
            return nil
        }
    }
    var containsWhitespace : Bool {
        return(self.rangeOfCharacter(from: .whitespacesAndNewlines) != nil)
    }
    
    var html2AttributedString: NSAttributedString? {
        do {
            return try NSAttributedString(data: Data(utf8), options: [NSAttributedString.DocumentReadingOptionKey.documentType:
                                                                        NSAttributedString.DocumentType.html], documentAttributes: nil)
            //   NSAttributedString(data: Data(utf8), options: [NSDocumentTypeDocumentAttribute: NSHTMLTextDocumentType, NSCharacterEncodingDocumentAttribute: String.Encoding.utf8.rawValue], documentAttributes: nil)
        } catch {
            print("error:", error)
            return nil
        }
    }
    var html2String: String {
        return html2AttributedString?.string ?? ""
    }
    func containsSet(find: String)->Bool?
    {
        
        var status = true
        for chara in find
        {
            if !self.contains(String(chara))
            {
                status = false
            }
            
        }
        return status
        
    }
    
    func localized(bundle: Bundle = .main, tableName: String = "Localizable") -> String {
        
        let locale              = Locale.autoupdatingCurrent
        let currentLanguageCode = getPreferredLocale().languageCode
        switch currentLanguageCode {
        case "fr":
            return NSLocalizedString(self, tableName: "French", value: "**\(self)**", comment: "")
        case "he":
            return NSLocalizedString(self, tableName: "Hebrew", value: "**\(self)**", comment: "")
        case "fr-CA" :
            return NSLocalizedString(self, tableName: "French", value: "**\(self)**", comment: "")
        case "ru" :
            return NSLocalizedString(self, tableName: "Russian", value: "**\(self)**", comment: "")
        case "uk" :
            return NSLocalizedString(self, tableName: "Russian", value: "**\(self)**", comment: "")
        case "ro" :
            return NSLocalizedString(self, tableName: "Russian", value: "**\(self)**", comment: "")
        case "be" :
            return NSLocalizedString(self, tableName: "Russian", value: "**\(self)**", comment: "")
        case "ka" :
            return NSLocalizedString(self, tableName: "Russian", value: "**\(self)**", comment: "")
        case "et" :
            return NSLocalizedString(self, tableName: "Russian", value: "**\(self)**", comment: "")
        case "he-IL" :
            return NSLocalizedString(self, tableName: "Hebrew", value: "**\(self)**", comment: "")
        default:
            return self
        }
        
    }
    func getPreferredLocale() -> Locale {
        guard let preferredIdentifier = Locale.preferredLanguages.first else {
            return Locale.current
        }
        return Locale(identifier: preferredIdentifier)
    }
}
extension NSLocale {
    class func locales1(countryName1 : String) -> String {
        let locales : String = ""
        for localeCode in NSLocale.isoCountryCodes {
            let countryName = (Locale.current as NSLocale).displayName(forKey: .countryCode, value: localeCode)
            if countryName1.lowercased() == countryName?.lowercased() {
                return localeCode
            }
        }
        return locales
    }
    
}
extension UIColor {
    /**
     The shorthand three-digit hexadecimal representation of color.
     #RGB defines to the color #RRGGBB.
     
     - parameter hex3: Three-digit hexadecimal value.
     - parameter alpha: 0.0 - 1.0. The default is 1.0.
     */
    public convenience init(hex3: UInt16, alpha: CGFloat = 1) {
        let divisor = CGFloat(15)
        let red     = CGFloat((hex3 & 0xF00) >> 8) / divisor
        let green   = CGFloat((hex3 & 0x0F0) >> 4) / divisor
        let blue    = CGFloat( hex3 & 0x00F      ) / divisor
        self.init(red: red, green: green, blue: blue, alpha: alpha)
    }
    
    /**
     The shorthand four-digit hexadecimal representation of color with alpha.
     #RGBA defines to the color #RRGGBBAA.
     
     - parameter hex4: Four-digit hexadecimal value.
     */
    public convenience init(hex4: UInt16) {
        let divisor = CGFloat(15)
        let red     = CGFloat((hex4 & 0xF000) >> 12) / divisor
        let green   = CGFloat((hex4 & 0x0F00) >>  8) / divisor
        let blue    = CGFloat((hex4 & 0x00F0) >>  4) / divisor
        let alpha   = CGFloat( hex4 & 0x000F       ) / divisor
        self.init(red: red, green: green, blue: blue, alpha: alpha)
    }
    
    /**
     The six-digit hexadecimal representation of color of the form #RRGGBB.
     
     - parameter hex6: Six-digit hexadecimal value.
     */
    public convenience init(hex6: UInt32, alpha: CGFloat = 1) {
        let divisor = CGFloat(255)
        let red     = CGFloat((hex6 & 0xFF0000) >> 16) / divisor
        let green   = CGFloat((hex6 & 0x00FF00) >>  8) / divisor
        let blue    = CGFloat( hex6 & 0x0000FF       ) / divisor
        self.init(red: red, green: green, blue: blue, alpha: alpha)
    }
    
    /**
     The six-digit hexadecimal representation of color with alpha of the form #RRGGBBAA.
     
     - parameter hex8: Eight-digit hexadecimal value.
     */
    public convenience init(hex8: UInt32) {
        let divisor = CGFloat(255)
        let red     = CGFloat((hex8 & 0xFF000000) >> 24) / divisor
        let green   = CGFloat((hex8 & 0x00FF0000) >> 16) / divisor
        let blue    = CGFloat((hex8 & 0x0000FF00) >>  8) / divisor
        let alpha   = CGFloat( hex8 & 0x000000FF       ) / divisor
        self.init(red: red, green: green, blue: blue, alpha: alpha)
    }
    
    /**
     The rgba string representation of color with alpha of the form #RRGGBBAA/#RRGGBB, throws error.
     
     - parameter rgba: String value.
     */
    public convenience init(rgba_throws rgba: String) throws {
        guard rgba.hasPrefix("#") else {
            throw UIColorInputError.missingHashMarkAsPrefix
        }
        
        let hexString: String = String(rgba.suffix(from: rgba.index(rgba.startIndex, offsetBy: 1)))
        var hexValue:  UInt32 = 0
        
        guard Scanner(string: hexString).scanHexInt32(&hexValue) else {
            throw UIColorInputError.unableToScanHexValue
        }
        
        switch (hexString.count) {
        case 3:
            self.init(hex3: UInt16(hexValue))
        case 4:
            self.init(hex4: UInt16(hexValue))
        case 6:
            self.init(hex6: hexValue)
        case 8:
            self.init(hex8: hexValue)
        default:
            throw UIColorInputError.mismatchedHexStringLength
        }
    }
    
    /**
     The rgba string representation of color with alpha of the form #RRGGBBAA/#RRGGBB, fails to default color.
     
     - parameter rgba: String value.
     */
    public convenience init(_ rgba: String, defaultColor: UIColor = UIColor.clear) {
        guard let color = try? UIColor(rgba_throws: rgba) else {
            self.init(cgColor: defaultColor.cgColor)
            return
        }
        self.init(cgColor: color.cgColor)
    }
    
    /**
     Hex string of a UIColor instance.
     
     - parameter includeAlpha: Whether the alpha should be included.
     */
    public func hexString(_ includeAlpha: Bool = true) -> String {
        var r: CGFloat = 0
        var g: CGFloat = 0
        var b: CGFloat = 0
        var a: CGFloat = 0
        self.getRed(&r, green: &g, blue: &b, alpha: &a)
        
        if (includeAlpha) {
            return String(format: "#%02X%02X%02X%02X", Int(r * 255), Int(g * 255), Int(b * 255), Int(a * 255))
        } else {
            return String(format: "#%02X%02X%02X", Int(r * 255), Int(g * 255), Int(b * 255))
        }
    }
}

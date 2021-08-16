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
        case "ar":
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
extension UITapGestureRecognizer {
    
    func didTapAttributedTextInLabel(label: UILabel, inRange targetRange: NSRange) -> Bool {
        // Create instances of NSLayoutManager, NSTextContainer and NSTextStorage
        let layoutManager = NSLayoutManager()
        let textContainer = NSTextContainer(size: CGSize.zero)
        let textStorage = NSTextStorage(attributedString: label.attributedText!)
        
        // Configure layoutManager and textStorage
        layoutManager.addTextContainer(textContainer)
        textStorage.addLayoutManager(layoutManager)
        
        // Configure textContainer
        textContainer.lineFragmentPadding = 0.0
        textContainer.lineBreakMode = label.lineBreakMode
        textContainer.maximumNumberOfLines = label.numberOfLines
        let labelSize = label.bounds.size
        textContainer.size = labelSize
        
        // Find the tapped character location and compare it to the specified range
        let locationOfTouchInLabel = self.location(in: label)
        let textBoundingBox = layoutManager.usedRect(for: textContainer)
        //let textContainerOffset = CGPointMake((labelSize.width - textBoundingBox.size.width) * 0.5 - textBoundingBox.origin.x,
        //(labelSize.height - textBoundingBox.size.height) * 0.5 - textBoundingBox.origin.y);
        let textContainerOffset = CGPoint(x: (labelSize.width - textBoundingBox.size.width) * 0.5 - textBoundingBox.origin.x, y: (labelSize.height - textBoundingBox.size.height) * 0.5 - textBoundingBox.origin.y)
        
        //let locationOfTouchInTextContainer = CGPointMake(locationOfTouchInLabel.x - textContainerOffset.x,
        // locationOfTouchInLabel.y - textContainerOffset.y);
        let locationOfTouchInTextContainer = CGPoint(x: locationOfTouchInLabel.x - textContainerOffset.x, y: locationOfTouchInLabel.y - textContainerOffset.y)
        let indexOfCharacter = layoutManager.characterIndex(for: locationOfTouchInTextContainer, in: textContainer, fractionOfDistanceBetweenInsertionPoints: nil)
        return NSLocationInRange(indexOfCharacter, targetRange)
    }
    
}

public extension UIDevice {

    static let modelName: String = {
        var systemInfo = utsname()
        uname(&systemInfo)
        let machineMirror = Mirror(reflecting: systemInfo.machine)
        let identifier = machineMirror.children.reduce("") { identifier, element in
            guard let value = element.value as? Int8, value != 0 else { return identifier }
            return identifier + String(UnicodeScalar(UInt8(value)))
        }

        func mapToDevice(identifier: String) -> String { // swiftlint:disable:this cyclomatic_complexity
            #if os(iOS)
            switch identifier {
            case "iPod5,1":                                 return "iPod touch (5th generation)"
            case "iPod7,1":                                 return "iPod touch (6th generation)"
            case "iPod9,1":                                 return "iPod touch (7th generation)"
            case "iPhone3,1", "iPhone3,2", "iPhone3,3":     return "iPhone 4"
            case "iPhone4,1":                               return "iPhone 4s"
            case "iPhone5,1", "iPhone5,2":                  return "iPhone 5"
            case "iPhone5,3", "iPhone5,4":                  return "iPhone 5c"
            case "iPhone6,1", "iPhone6,2":                  return "iPhone 5s"
            case "iPhone7,2":                               return "iPhone 6"
            case "iPhone7,1":                               return "iPhone 6 Plus"
            case "iPhone8,1":                               return "iPhone 6s"
            case "iPhone8,2":                               return "iPhone 6s Plus"
            case "iPhone8,4":                               return "iPhone SE"
            case "iPhone9,1", "iPhone9,3":                  return "iPhone 7"
            case "iPhone9,2", "iPhone9,4":                  return "iPhone 7 Plus"
            case "iPhone10,1", "iPhone10,4":                return "iPhone 8"
            case "iPhone10,2", "iPhone10,5":                return "iPhone 8 Plus"
            case "iPhone10,3", "iPhone10,6":                return "iPhone X"
            case "iPhone11,2":                              return "iPhone XS"
            case "iPhone11,4", "iPhone11,6":                return "iPhone XS Max"
            case "iPhone11,8":                              return "iPhone XR"
            case "iPhone12,1":                              return "iPhone 11"
            case "iPhone12,3":                              return "iPhone 11 Pro"
            case "iPhone12,5":                              return "iPhone 11 Pro Max"
            case "iPhone12,8":                              return "iPhone SE (2nd generation)"
            case "iPhone13,1":                              return "iPhone 12 mini"
            case "iPhone13,2":                              return "iPhone 12"
            case "iPhone13,3":                              return "iPhone 12 Pro"
            case "iPhone13,4":                              return "iPhone 12 Pro Max"
            case "iPad2,1", "iPad2,2", "iPad2,3", "iPad2,4":return "iPad 2"
            case "iPad3,1", "iPad3,2", "iPad3,3":           return "iPad (3rd generation)"
            case "iPad3,4", "iPad3,5", "iPad3,6":           return "iPad (4th generation)"
            case "iPad6,11", "iPad6,12":                    return "iPad (5th generation)"
            case "iPad7,5", "iPad7,6":                      return "iPad (6th generation)"
            case "iPad7,11", "iPad7,12":                    return "iPad (7th generation)"
            case "iPad11,6", "iPad11,7":                    return "iPad (8th generation)"
            case "iPad4,1", "iPad4,2", "iPad4,3":           return "iPad Air"
            case "iPad5,3", "iPad5,4":                      return "iPad Air 2"
            case "iPad11,3", "iPad11,4":                    return "iPad Air (3rd generation)"
            case "iPad13,1", "iPad13,2":                    return "iPad Air (4th generation)"
            case "iPad2,5", "iPad2,6", "iPad2,7":           return "iPad mini"
            case "iPad4,4", "iPad4,5", "iPad4,6":           return "iPad mini 2"
            case "iPad4,7", "iPad4,8", "iPad4,9":           return "iPad mini 3"
            case "iPad5,1", "iPad5,2":                      return "iPad mini 4"
            case "iPad11,1", "iPad11,2":                    return "iPad mini (5th generation)"
            case "iPad6,3", "iPad6,4":                      return "iPad Pro (9.7-inch)"
            case "iPad7,3", "iPad7,4":                      return "iPad Pro (10.5-inch)"
            case "iPad8,1", "iPad8,2", "iPad8,3", "iPad8,4":return "iPad Pro (11-inch) (1st generation)"
            case "iPad8,9", "iPad8,10":                     return "iPad Pro (11-inch) (2nd generation)"
            case "iPad6,7", "iPad6,8":                      return "iPad Pro (12.9-inch) (1st generation)"
            case "iPad7,1", "iPad7,2":                      return "iPad Pro (12.9-inch) (2nd generation)"
            case "iPad8,5", "iPad8,6", "iPad8,7", "iPad8,8":return "iPad Pro (12.9-inch) (3rd generation)"
            case "iPad8,11", "iPad8,12":                    return "iPad Pro (12.9-inch) (4th generation)"
            case "AppleTV5,3":                              return "Apple TV"
            case "AppleTV6,2":                              return "Apple TV 4K"
            case "AudioAccessory1,1":                       return "HomePod"
            case "AudioAccessory5,1":                       return "HomePod mini"
            case "i386", "x86_64":                          return "Simulator \(mapToDevice(identifier: ProcessInfo().environment["SIMULATOR_MODEL_IDENTIFIER"] ?? "iOS"))"
            default:                                        return identifier
            }
            #elseif os(tvOS)
            switch identifier {
            case "AppleTV5,3": return "Apple TV 4"
            case "AppleTV6,2": return "Apple TV 4K"
            case "i386", "x86_64": return "Simulator \(mapToDevice(identifier: ProcessInfo().environment["SIMULATOR_MODEL_IDENTIFIER"] ?? "tvOS"))"
            default: return identifier
            }
            #endif
        }

        return mapToDevice(identifier: identifier)
    }()

}
extension Date {
    func dayOfTheWeek() -> String? {
        let dateFormatter = DateFormatter()
        dateFormatter.dateFormat = "EEEE"
        return dateFormatter.string(from: self)
    }
}
extension String {
    var appFormattedDate : String {
        let dateFormatter = DateFormatter()
        dateFormatter.dateFormat = "yyyy-MM-dd"
        let date = dateFormatter.date(from: self)
        dateFormatter.dateFormat = "dd/MM/yyyy"
        return dateFormatter.string(from: date!)
        
    }
    var appFormattedDateOffereDetail : String {
        let dateFormatter = DateFormatter()
        dateFormatter.dateFormat = "dd-MM-yyyy"
        let date = dateFormatter.date(from: self)
        dateFormatter.dateFormat = "dd/MM/yyyy"
        return dateFormatter.string(from: date!)
        
    }
    
}
extension Double {
    var clean: String {
       return self.truncatingRemainder(dividingBy: 1) == 0 ? String(format: "%.0f", self) : String(self)
    }
}

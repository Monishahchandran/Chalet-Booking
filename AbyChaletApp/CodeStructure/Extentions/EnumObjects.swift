//
//  EnumObjects.swift
//  AbyChaletApp
//
//  Created by TEJASWINI KADAM on 28/04/21.
//

import Foundation
//"Holidays and Events", "Weekdays", "Weekend", "Week (A)", "Week (B)"
enum PackageType: String {
    case weekB = "Week (B)"
    case weekA = "Week (A)"
    case weekend = "Weekend"
    case weekdays = "Weekdays"
    case holidaysEvents = "Holidays and Events"
}
enum VerificationSuccessFrom {
    case signUp
    case forgotPassword
}
enum VerificationCodeFrom {
    case signUp
    case forgotPassword
}

//
//  Countdown.swift
//
//
//  Created by Visakh M P on 14/05/20.
//

import Foundation

func defaultUpdateActionHandler(string:String)->(){

}

func defaultCompletionActionHandler()->(){

}

public class DateCountDownTimer{

    var countdownTimer: Timer!
    var totalTime = 60
    var dateString = "March 4, 2018 13:20:10" as String
    var UpdateActionHandler:(String)->() = defaultUpdateActionHandler
    var CompletionActionHandler:()->() = defaultCompletionActionHandler

    public init(){
        countdownTimer = Timer()
        totalTime = 60
        dateString = "March 4, 2018 13:20:10" as String
        UpdateActionHandler = defaultUpdateActionHandler
        CompletionActionHandler = defaultCompletionActionHandler
    }

    public func initializeTimer(_ date: String) {

        self.dateString = date

        // Setting Today's Date
        let currentDate = Date()

        // Setting TargetDate
        let dateFormatter = DateFormatter()
        dateFormatter.dateFormat = "yyyy-MM-dd HH:mm:ss"
        //dateFormatter.dateFormat = "hh:mm a"
        dateFormatter.timeZone = NSTimeZone.local
        if let targedDate = dateFormatter.date(from: dateString) {

            let currentD = dateFormatter.string(from: currentDate)
            let cuD = dateFormatter.date(from: currentD)
        // Calculating the difference of dates for timer
            let calendar = Calendar.current.dateComponents([.day, .hour, .minute, .second], from: cuD!, to: targedDate)
        let days = calendar.day!
        let hours = calendar.hour!
        let minutes = calendar.minute!
        let seconds = calendar.second!
        totalTime = hours * 60 * 60 + minutes * 60 + seconds
        totalTime = days * 60 * 60 * 24 + totalTime
    }
    }

    func numberOfDaysInMonth(month:Int) -> Int{
        let dateComponents = DateComponents(year: 2015, month: 7)
        let calendar = Calendar.current
        let date = calendar.date(from: dateComponents)!

        let range = calendar.range(of: .day, in: .month, for: date)!
        let numDays = range.count
        //print(numDays)
        return numDays
    }

    public func startTimer(pUpdateActionHandler:@escaping (String)->(),pCompletionActionHandler:@escaping ()->()) {
        countdownTimer = Timer.scheduledTimer(timeInterval: 1, target: self, selector: #selector(updateTime), userInfo: nil, repeats: true)
        self.CompletionActionHandler = pCompletionActionHandler
        self.UpdateActionHandler = pUpdateActionHandler
    }

    @objc func updateTime() {
        self.UpdateActionHandler(timeFormatted(totalTime))

        if totalTime > 0 {
            totalTime -= 1
        } else {
            endTimer()
        }
    }

    func endTimer() {
        self.CompletionActionHandler()
        countdownTimer.invalidate()
    }

    func timeFormatted(_ totalSeconds: Int) -> String {
        let seconds: Int = totalSeconds % 60
        let minutes: Int = (totalSeconds / 60) % 60
        let hours: Int = (totalSeconds / 60 / 60) % 24
        let days: Int = (totalSeconds / 60 / 60 / 24)
        
        if days > 0 {
            return String(format: "%d d %02d h %02d m %02d s", days, hours, minutes, seconds)

        }else if hours > 0 {
            return String(format: "%02d h %02d m %02d s", hours, minutes, seconds)

        }else if minutes > 0  {
            return String(format: "%02d m %02d s",minutes, seconds)
        }else {
            return String(format: "%02d Second", seconds)
        }
    }

}

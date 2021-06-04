

import Foundation
 

public class CalendarListBase {
	public var status : Bool?
	public var message : String?
	public var calendarData : [CalendarData]?


    public class func modelsFromDictionaryArray(array:NSArray) -> [CalendarListBase]
    {
        var models:[CalendarListBase] = []
        for item in array
        {
            models.append(CalendarListBase(dictionary: item as! NSDictionary)!)
        }
        return models
    }


	required public init?(dictionary: NSDictionary) {

		status = dictionary["status"] as? Bool
		message = dictionary["message"] as? String
        if (dictionary["data"] != nil) { calendarData = CalendarData.modelsFromDictionaryArray(array: dictionary["data"] as! NSArray) }
	}


	public func dictionaryRepresentation() -> NSDictionary {

		let dictionary = NSMutableDictionary()

		dictionary.setValue(self.status, forKey: "status")
		dictionary.setValue(self.message, forKey: "message")

		return dictionary
	}

}
public class CalendarData {
    public var start_date : String?
    public var end_date : String?
    public var package_period : String?
    public var available_status : Bool?


    public class func modelsFromDictionaryArray(array:NSArray) -> [CalendarData]
    {
        var models:[CalendarData] = []
        for item in array
        {
            models.append(CalendarData(dictionary: item as! NSDictionary)!)
        }
        return models
    }


    required public init?(dictionary: NSDictionary) {

        start_date = dictionary["start_date"] as? String
        end_date = dictionary["end_date"] as? String
        package_period = dictionary["package_period"] as? String
        available_status = dictionary["available_status"] as? Bool
    }

    public func dictionaryRepresentation() -> NSDictionary {

        let dictionary = NSMutableDictionary()

        dictionary.setValue(self.start_date, forKey: "start_date")
        dictionary.setValue(self.end_date, forKey: "end_date")
        dictionary.setValue(self.package_period, forKey: "package_period")
        dictionary.setValue(self.available_status, forKey: "available_status")

        return dictionary
    }

}
class JobsPerDate : NSObject {
    var jobDate : Int!
    var jobMonth: Int!
    var jobYear : Int!
    var jobCount : Int!
    var jobFormatYear : String!
    var jobID          : String
    
    init(_ jobDate : Int ,jobMonth : Int,jobYear : Int ,jobCount : Int,jobFormatYear:String,jobID:String) {
        self.jobDate = jobDate
        self.jobMonth = jobMonth
        self.jobYear = jobYear
        self.jobCount = jobCount
        self.jobFormatYear = jobFormatYear
        self.jobID = jobID
    }
}

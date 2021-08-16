

import Foundation
 

public class HolidaysAndEventsBas {
	public var status : Bool?
	public var message : String?
	public var chalet_list : [Chalet_list]?

    public class func modelsFromDictionaryArray(array:NSArray) -> [HolidaysAndEventsBas]
    {
        var models:[HolidaysAndEventsBas] = []
        for item in array
        {
            models.append(HolidaysAndEventsBas(dictionary: item as! NSDictionary)!)
        }
        return models
    }

	required public init?(dictionary: NSDictionary) {

		status = dictionary["status"] as? Bool
		message = dictionary["message"] as? String
        if (dictionary["chalet_list"] != nil) { chalet_list = Chalet_list.modelsFromDictionaryArray(array: dictionary["chalet_list"] as! NSArray) }
	}

	public func dictionaryRepresentation() -> NSDictionary {

		let dictionary = NSMutableDictionary()

		dictionary.setValue(self.status, forKey: "status")
		dictionary.setValue(self.message, forKey: "message")

		return dictionary
	}

}
public class Chalet_list {
    public var id : Int?
    public var event_name : String?
    public var check_in : String?
    public var check_out : String?
    
    public var admincheck_in : String?
    public var admincheck_out : String?
    public var user_details : [User_details]?
    public class func modelsFromDictionaryArray(array:NSArray) -> [Chalet_list]
    {
        var models:[Chalet_list] = []
        for item in array
        {
            models.append(Chalet_list(dictionary: item as! NSDictionary)!)
        }
        return models
    }


    required public init?(dictionary: NSDictionary) {

        id = dictionary["id"] as? Int
        event_name = dictionary["event_name"] as? String
        check_in = dictionary["events_checkin"] as? String
        check_out = dictionary["events_checkout"] as? String
        admincheck_in = dictionary["admin_check_in"] as? String
        admincheck_out = dictionary["admin_check_out"] as? String
        if (dictionary["user_details"] != nil) { user_details = User_details.modelsFromDictionaryArray(array: dictionary["user_details"] as! NSArray) }
    }

    public func dictionaryRepresentation() -> NSDictionary {

        let dictionary = NSMutableDictionary()

        dictionary.setValue(self.id, forKey: "id")
        dictionary.setValue(self.event_name, forKey: "event_name")
        dictionary.setValue(self.check_in, forKey: "events_checkin")
        dictionary.setValue(self.check_out, forKey: "events_checkout")

        return dictionary
    }

}

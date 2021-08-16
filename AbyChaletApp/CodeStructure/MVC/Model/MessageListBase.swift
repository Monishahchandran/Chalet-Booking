

import Foundation
 

public class MessageListBase {
	public var status : Bool?
	public var message : String?
	public var notifcation : [Message_Notifcation]?


    public class func modelsFromDictionaryArray(array:NSArray) -> [MessageListBase]
    {
        var models:[MessageListBase] = []
        for item in array
        {
            models.append(MessageListBase(dictionary: item as! NSDictionary)!)
        }
        return models
    }


	required public init?(dictionary: NSDictionary) {

		status = dictionary["status"] as? Bool
		message = dictionary["message"] as? String
        if (dictionary["notifcation"] != nil) { notifcation = Message_Notifcation.modelsFromDictionaryArray(array: dictionary["notifcation"] as! NSArray) }
	}


	public func dictionaryRepresentation() -> NSDictionary {

		let dictionary = NSMutableDictionary()

		dictionary.setValue(self.status, forKey: "status")
		dictionary.setValue(self.message, forKey: "message")

		return dictionary
	}

}
public class Message_Notifcation {
    public var notification_id : Int?
    public var userid : Int?
    public var notification_title : String?
    public var notification_message : String?
    public var notification_status : String?
    public var message_status : String?
    public var reservation_id : Int?
    public var reservation_status : String?
    public var created_at : String?
    public var updated_at : String?
    public var reservation_details : [Reservation_details]?


    public class func modelsFromDictionaryArray(array:NSArray) -> [Message_Notifcation]
    {
        var models:[Message_Notifcation] = []
        for item in array
        {
            models.append(Message_Notifcation(dictionary: item as! NSDictionary)!)
        }
        return models
    }


    required public init?(dictionary: NSDictionary) {

        notification_id = dictionary["notification_id"] as? Int
        userid = dictionary["userid"] as? Int
        notification_title = dictionary["notification_title"] as? String
        notification_message = dictionary["notification_message"] as? String
        notification_status = dictionary["notification_status"] as? String
        message_status = dictionary["message_status"] as? String
        reservation_id = dictionary["reservation_id"] as? Int
        reservation_status = dictionary["reservation_status"] as? String
        created_at = dictionary["created_at"] as? String
        updated_at = dictionary["updated_at"] as? String
        if (dictionary["reservation_details"] != nil) { reservation_details = Reservation_details.modelsFromDictionaryArray(array: dictionary["reservation_details"] as! NSArray) }
    }


    public func dictionaryRepresentation() -> NSDictionary {

        let dictionary = NSMutableDictionary()

        dictionary.setValue(self.notification_id, forKey: "notification_id")
        dictionary.setValue(self.userid, forKey: "userid")
        dictionary.setValue(self.notification_title, forKey: "notification_title")
        dictionary.setValue(self.notification_message, forKey: "notification_message")
        dictionary.setValue(self.notification_status, forKey: "notification_status")
        dictionary.setValue(self.message_status, forKey: "message_status")
        dictionary.setValue(self.reservation_id, forKey: "reservation_id")
        dictionary.setValue(self.reservation_status, forKey: "reservation_status")
        dictionary.setValue(self.created_at, forKey: "created_at")
        dictionary.setValue(self.updated_at, forKey: "updated_at")

        return dictionary
    }

}
public class Reservation_details {
    public var id : Int?
    public var userid : Int?
    public var chaletid : Int?
    public var selected_package : String?
    public var check_in : String?
    public var check_out : String?
    public var checkin_time : String?
    public var checkout_time : String?
    public var rent : String?
    public var reservation_id : String?
    public var total_paid : String?
    public var reward_discount : String?
    public var remaining_amt : String?
    public var canceled_date : String?
    public var chalet_details : [Reservation_Chalet_details]?


    public class func modelsFromDictionaryArray(array:NSArray) -> [Reservation_details]
    {
        var models:[Reservation_details] = []
        for item in array
        {
            models.append(Reservation_details(dictionary: item as! NSDictionary)!)
        }
        return models
    }


    required public init?(dictionary: NSDictionary) {

        id = dictionary["id"] as? Int
        userid = dictionary["userid"] as? Int
        chaletid = dictionary["chaletid"] as? Int
        selected_package = dictionary["selected_package"] as? String
        check_in = dictionary["check_in"] as? String
        check_out = dictionary["check_out"] as? String
        checkin_time = dictionary["checkin_time"] as? String
        checkout_time = dictionary["checkout_time"] as? String
        rent = dictionary["rent"] as? String
        reservation_id = dictionary["reservation_id"] as? String
        total_paid = dictionary["total_paid"] as? String
        reward_discount = dictionary["reward_discount"] as? String
        remaining_amt = dictionary["remaining_amt"] as? String
        canceled_date = dictionary["canceled_date"] as? String
        if (dictionary["chalet_details"] != nil) { chalet_details = Reservation_Chalet_details.modelsFromDictionaryArray(array: dictionary["chalet_details"] as! NSArray) }
    }


    public func dictionaryRepresentation() -> NSDictionary {

        let dictionary = NSMutableDictionary()

        dictionary.setValue(self.id, forKey: "id")
        dictionary.setValue(self.userid, forKey: "userid")
        dictionary.setValue(self.chaletid, forKey: "chaletid")
        dictionary.setValue(self.selected_package, forKey: "selected_package")
        dictionary.setValue(self.check_in, forKey: "check_in")
        dictionary.setValue(self.check_out, forKey: "check_out")
        dictionary.setValue(self.rent, forKey: "rent")
        dictionary.setValue(self.reservation_id, forKey: "reservation_id")
        dictionary.setValue(self.total_paid, forKey: "total_paid")
        dictionary.setValue(self.reward_discount, forKey: "reward_discount")

        return dictionary
    }

}
public class Reservation_Chalet_details {
    public var chalet_id : Int?
    public var chalet_name : String?
    public var location : String?
    public var owner_id : Int?
    public var firstname : String?
    public var lastname : String?
    public var email : String?
    public var password : String?
    public var country : String?
    public var phone : String?
    public var gender : String?
    public var profile_pic : String?
    public var created_at : String?
    public var updated_at : String?
    public var cover_photo : String?

    

    public class func modelsFromDictionaryArray(array:NSArray) -> [Reservation_Chalet_details]
    {
        var models:[Reservation_Chalet_details] = []
        for item in array
        {
            models.append(Reservation_Chalet_details(dictionary: item as! NSDictionary)!)
        }
        return models
    }


    required public init?(dictionary: NSDictionary) {

        chalet_id = dictionary["chalet_id"] as? Int
        chalet_name = dictionary["chalet_name"] as? String
        location = dictionary["location"] as? String
        owner_id = dictionary["owner_id"] as? Int
        firstname = dictionary["firstname"] as? String
        lastname = dictionary["lastname"] as? String
        email = dictionary["email"] as? String
        password = dictionary["password"] as? String
        country = dictionary["country"] as? String
        phone = dictionary["phone"] as? String
        gender = dictionary["gender"] as? String
        profile_pic = dictionary["profile_pic"] as? String
        created_at = dictionary["created_at"] as? String
        updated_at = dictionary["updated_at"] as? String
        cover_photo = dictionary["cover_photo"] as? String
    }

        

    public func dictionaryRepresentation() -> NSDictionary {

        let dictionary = NSMutableDictionary()

        dictionary.setValue(self.chalet_id, forKey: "chalet_id")
        dictionary.setValue(self.chalet_name, forKey: "chalet_name")
        dictionary.setValue(self.location, forKey: "location")
        dictionary.setValue(self.owner_id, forKey: "owner_id")
        dictionary.setValue(self.firstname, forKey: "firstname")
        dictionary.setValue(self.lastname, forKey: "lastname")
        dictionary.setValue(self.email, forKey: "email")
        dictionary.setValue(self.password, forKey: "password")
        dictionary.setValue(self.country, forKey: "country")
        dictionary.setValue(self.phone, forKey: "phone")
        dictionary.setValue(self.gender, forKey: "gender")
        dictionary.setValue(self.profile_pic, forKey: "profile_pic")
        dictionary.setValue(self.created_at, forKey: "created_at")
        dictionary.setValue(self.updated_at, forKey: "updated_at")

        return dictionary
    }

}

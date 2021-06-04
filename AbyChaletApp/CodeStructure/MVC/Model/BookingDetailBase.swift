

import Foundation
 

public class BookingDetailBase {
	public var status : Bool?
	public var message : String?
	public var booking_details : Booking_details?


    public class func modelsFromDictionaryArray(array:NSArray) -> [BookingDetailBase]
    {
        var models:[BookingDetailBase] = []
        for item in array
        {
            models.append(BookingDetailBase(dictionary: item as! NSDictionary)!)
        }
        return models
    }


	required public init?(dictionary: NSDictionary) {

		status = dictionary["status"] as? Bool
		message = dictionary["message"] as? String
		if (dictionary["booking_details"] != nil) { booking_details = Booking_details(dictionary: dictionary["booking_details"] as! NSDictionary) }
	}


	public func dictionaryRepresentation() -> NSDictionary {

		let dictionary = NSMutableDictionary()

		dictionary.setValue(self.status, forKey: "status")
		dictionary.setValue(self.message, forKey: "message")
		dictionary.setValue(self.booking_details?.dictionaryRepresentation(), forKey: "booking_details")

		return dictionary
	}

}
public class Booking_details {
    public var id : Int?
    public var userid : Int?
    public var chaletid : Int?
    public var chalet_name : String?
    public var location : String?
    public var latitude : Double?
    public var longitude : Double?
    public var selected_package : String?
    public var check_in : String?
    public var check_out : String?
    public var checkin_time : String?
    public var checkout_time : String?
    public var reservation_id : String?
    public var total_paid : String?
    public var reward_discount : String?
    public var deposit : String?
    public var rent : String?
    public var status : String?
    public var remaining : Int?
    public var ownerid : Int?
    public var offer_discount : String?
    public var chalet_details : [Chalet_details]?
    public var chalet_upload : [Chalet_upload]?


    public class func modelsFromDictionaryArray(array:NSArray) -> [Booking_details]
    {
        var models:[Booking_details] = []
        for item in array
        {
            models.append(Booking_details(dictionary: item as! NSDictionary)!)
        }
        return models
    }

    required public init?(dictionary: NSDictionary) {

        id = dictionary["id"] as? Int
        userid = dictionary["userid"] as? Int
        chaletid = dictionary["chaletid"] as? Int
        chalet_name = dictionary["chalet_name"] as? String
        location = dictionary["location"] as? String
        latitude = dictionary["latitude"] as? Double
        longitude = dictionary["longitude"] as? Double
        selected_package = dictionary["selected_package"] as? String
        check_in = dictionary["check_in"] as? String
        check_out = dictionary["check_out"] as? String
        checkin_time = dictionary["checkin_time"] as? String
        checkout_time = dictionary["checkout_time"] as? String
        reservation_id = dictionary["reservation_id"] as? String
        total_paid = dictionary["total_paid"] as? String
        reward_discount = dictionary["reward_discount"] as? String
        deposit = dictionary["deposit"] as? String
        rent = dictionary["rent"] as? String
        status = dictionary["status"] as? String
        remaining = dictionary["remaining"] as? Int
        ownerid = dictionary["ownerid"] as? Int
        offer_discount = dictionary["offer_discount"] as? String
        if (dictionary["chalet_details"] != nil) { chalet_details = Chalet_details.modelsFromDictionaryArray(array: dictionary["chalet_details"] as! NSArray) }
        if (dictionary["chalet_upload"] != nil) { chalet_upload = Chalet_upload.modelsFromDictionaryArray(array: dictionary["chalet_upload"] as! NSArray) }
    }

    public func dictionaryRepresentation() -> NSDictionary {

        let dictionary = NSMutableDictionary()

        dictionary.setValue(self.id, forKey: "id")
        dictionary.setValue(self.userid, forKey: "userid")
        dictionary.setValue(self.chaletid, forKey: "chaletid")
        dictionary.setValue(self.chalet_name, forKey: "chalet_name")
        dictionary.setValue(self.location, forKey: "location")
        dictionary.setValue(self.selected_package, forKey: "selected_package")
        dictionary.setValue(self.check_in, forKey: "check_in")
        dictionary.setValue(self.check_out, forKey: "check_out")
        dictionary.setValue(self.checkin_time, forKey: "checkin_time")
        dictionary.setValue(self.checkout_time, forKey: "checkout_time")
        dictionary.setValue(self.reservation_id, forKey: "reservation_id")
        dictionary.setValue(self.total_paid, forKey: "total_paid")
        dictionary.setValue(self.reward_discount, forKey: "reward_discount")
        dictionary.setValue(self.deposit, forKey: "deposit")
        dictionary.setValue(self.rent, forKey: "rent")
        dictionary.setValue(self.status, forKey: "status")
        dictionary.setValue(self.remaining, forKey: "remaining")
        dictionary.setValue(self.ownerid, forKey: "ownerid")
        dictionary.setValue(self.offer_discount, forKey: "offer_discount")

        return dictionary
    }

}


import Foundation
 

public class MyBookingBase {
	public var status : Bool?
	public var message : String?
	public var reward_details : [Reward_details]?
	public var myBooking_details : [MyBooking_details]?


    public class func modelsFromDictionaryArray(array:NSArray) -> [MyBookingBase]
    {
        var models:[MyBookingBase] = []
        for item in array
        {
            models.append(MyBookingBase(dictionary: item as! NSDictionary)!)
        }
        return models
    }


	required public init?(dictionary: NSDictionary) {

		status = dictionary["status"] as? Bool
		message = dictionary["message"] as? String
        if (dictionary["reward_details"] != nil) { reward_details = Reward_details.modelsFromDictionaryArray(array: dictionary["reward_details"] as! NSArray) }
        if (dictionary["booking_details"] != nil) { myBooking_details = MyBooking_details.modelsFromDictionaryArray(array: dictionary["booking_details"] as! NSArray) }
	}

	public func dictionaryRepresentation() -> NSDictionary {

		let dictionary = NSMutableDictionary()

		dictionary.setValue(self.status, forKey: "status")
		dictionary.setValue(self.message, forKey: "message")

		return dictionary
	}

}
public class Reward_details {
    public var reward_earn : String?
    public var every_spend : String?
    public var rewarded_amt : String?
    public var sum_total_paid : Int?
    public var total : Int?
    

    public class func modelsFromDictionaryArray(array:NSArray) -> [Reward_details]
    {
        var models:[Reward_details] = []
        for item in array
        {
            models.append(Reward_details(dictionary: item as! NSDictionary)!)
        }
        return models
    }

    required public init?(dictionary: NSDictionary) {

        reward_earn = dictionary["reward_earn"] as? String
        every_spend = dictionary["every_spend"] as? String
        rewarded_amt = dictionary["rewarded_amt"] as? String
        sum_total_paid = dictionary["sum_total_paid"] as? Int
        total = dictionary["total"] as? Int
    }

    public func dictionaryRepresentation() -> NSDictionary {

        let dictionary = NSMutableDictionary()

        dictionary.setValue(self.reward_earn, forKey: "reward_earn")
        dictionary.setValue(self.every_spend, forKey: "every_spend")
        dictionary.setValue(self.rewarded_amt, forKey: "rewarded_amt")
        dictionary.setValue(self.sum_total_paid, forKey: "sum_total_paid")
        dictionary.setValue(self.total, forKey: "total")

        return dictionary
    }

}
public class MyBooking_details {
    public var id : Int?
    public var userid : Int?
    public var chaletid : Int?
    public var selected_package : String?
    public var check_in : String?
    public var check_out : String?
    public var admincheck_in : String?
    public var admincheck_out : String?
    public var rent : String?
    public var reservation_id : String?
    public var total_paid : String?
    public var reward_discount : String?
    public var deposit : String?
    public var status : String?
    public var active_status : String?
    public var booking_status : String?
    public var ownerid : Int?
    public var offer_discount : String?
    public var myBookingChalet_details : [MyBookingChalet_details]?

    public class func modelsFromDictionaryArray(array:NSArray) -> [MyBooking_details]
    {
        var models:[MyBooking_details] = []
        for item in array
        {
            models.append(MyBooking_details(dictionary: item as! NSDictionary)!)
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
        admincheck_in = dictionary["admincheck_in"] as? String
        admincheck_out = dictionary["admincheck_out"] as? String
        rent = dictionary["rent"] as? String
        reservation_id = dictionary["reservation_id"] as? String
        total_paid = dictionary["total_paid"] as? String
        reward_discount = dictionary["reward_discount"] as? String
        deposit = dictionary["deposit"] as? String
        status = dictionary["status"] as? String
        active_status = dictionary["active_status"] as? String
        booking_status = dictionary["booking_status"] as? String
        ownerid = dictionary["ownerid"] as? Int
        offer_discount = dictionary["offer_discount"] as? String
        if (dictionary["chalet_details"] != nil) { myBookingChalet_details = MyBookingChalet_details.modelsFromDictionaryArray(array: dictionary["chalet_details"] as! NSArray) }
    }

    public func dictionaryRepresentation() -> NSDictionary {

        let dictionary = NSMutableDictionary()

        dictionary.setValue(self.id, forKey: "id")
        dictionary.setValue(self.userid, forKey: "userid")
        dictionary.setValue(self.chaletid, forKey: "chaletid")
        dictionary.setValue(self.selected_package, forKey: "selected_package")
        dictionary.setValue(self.check_in, forKey: "check_in")
        dictionary.setValue(self.check_out, forKey: "check_out")
        dictionary.setValue(self.admincheck_in, forKey: "admincheck_in")
        dictionary.setValue(self.admincheck_out, forKey: "admincheck_out")
        dictionary.setValue(self.rent, forKey: "rent")
        dictionary.setValue(self.reservation_id, forKey: "reservation_id")
        dictionary.setValue(self.total_paid, forKey: "total_paid")
        dictionary.setValue(self.reward_discount, forKey: "reward_discount")
        dictionary.setValue(self.deposit, forKey: "deposit")
        dictionary.setValue(self.status, forKey: "status")
        dictionary.setValue(self.active_status, forKey: "active_status")
        dictionary.setValue(self.ownerid, forKey: "ownerid")
        dictionary.setValue(self.offer_discount, forKey: "offer_discount")

        return dictionary
    }

}
public class MyBookingChalet_details {
    public var chalet_id : Int?
    public var chalet_name : String?
    public var location : String?
    public var latitude : String?
    public var longitude : String?
    public var weekday_rent : String?
    public var weekend_rent : String?
    public var week_rent : String?
    public var owner_id : Int?
    public var firstname : String?
    public var lastname : String?
    public var email : String?
    public var password : String?
    public var country : String?
    public var phone : String?
    public var gender : String?
    public var profile_pic : String?
    public var cover_photo : String?
    public var civil_id : String?
    public var chalet_ownership : String?
    public var bank_holder_name : String?
    public var bank_name : String?
    public var iban_num : String?
    public var availablility_status : String?
    public var chalet_details : [Chalet_details]?
    public var chalet_upload : [Chalet_upload]?
    public var created_at : String?
    public var updated_at : String?
    public var remaining_amt_pay : String?
    public var available_deposit : String?

    public class func modelsFromDictionaryArray(array:NSArray) -> [MyBookingChalet_details]
    {
        var models:[MyBookingChalet_details] = []
        for item in array
        {
            models.append(MyBookingChalet_details(dictionary: item as! NSDictionary)!)
        }
        return models
    }

    required public init?(dictionary: NSDictionary) {

        chalet_id = dictionary["chalet_id"] as? Int
        chalet_name = dictionary["chalet_name"] as? String
        location = dictionary["location"] as? String
        latitude = dictionary["latitude"] as? String
        longitude = dictionary["longitude"] as? String
        weekday_rent = dictionary["weekday_rent"] as? String
        weekend_rent = dictionary["weekend_rent"] as? String
        week_rent = dictionary["week_rent"] as? String
        owner_id = dictionary["owner_id"] as? Int
        firstname = dictionary["firstname"] as? String
        lastname = dictionary["lastname"] as? String
        email = dictionary["email"] as? String
        password = dictionary["password"] as? String
        country = dictionary["country"] as? String
        phone = dictionary["phone"] as? String
        gender = dictionary["gender"] as? String
        profile_pic = dictionary["profile_pic"] as? String
        cover_photo = dictionary["cover_photo"] as? String
        civil_id = dictionary["civil_id"] as? String
        chalet_ownership = dictionary["chalet_ownership"] as? String
        bank_holder_name = dictionary["bank_holder_name"] as? String
        bank_name = dictionary["bank_name"] as? String
        iban_num = dictionary["iban_num"] as? String
        availablility_status = dictionary["availablility_status"] as? String
        if (dictionary["chalet_details"] != nil) { chalet_details = Chalet_details.modelsFromDictionaryArray(array: dictionary["chalet_details"] as! NSArray) }
        if (dictionary["chalet_upload"] != nil) { chalet_upload = Chalet_upload.modelsFromDictionaryArray(array: dictionary["chalet_upload"] as! NSArray) }
        created_at = dictionary["created_at"] as? String
        updated_at = dictionary["updated_at"] as? String
        remaining_amt_pay = dictionary["remaining_amt_pay"] as? String
        available_deposit = dictionary["available_deposit"] as? String
    }

    public func dictionaryRepresentation() -> NSDictionary {

        let dictionary = NSMutableDictionary()

        dictionary.setValue(self.chalet_id, forKey: "chalet_id")
        dictionary.setValue(self.chalet_name, forKey: "chalet_name")
        dictionary.setValue(self.location, forKey: "location")
        dictionary.setValue(self.latitude, forKey: "latitude")
        dictionary.setValue(self.longitude, forKey: "longitude")
        dictionary.setValue(self.weekday_rent, forKey: "weekday_rent")
        dictionary.setValue(self.weekend_rent, forKey: "weekend_rent")
        dictionary.setValue(self.week_rent, forKey: "week_rent")
        dictionary.setValue(self.owner_id, forKey: "owner_id")
        dictionary.setValue(self.firstname, forKey: "firstname")
        dictionary.setValue(self.lastname, forKey: "lastname")
        dictionary.setValue(self.email, forKey: "email")
        dictionary.setValue(self.password, forKey: "password")
        dictionary.setValue(self.country, forKey: "country")
        dictionary.setValue(self.phone, forKey: "phone")
        dictionary.setValue(self.gender, forKey: "gender")
        dictionary.setValue(self.profile_pic, forKey: "profile_pic")
        dictionary.setValue(self.cover_photo, forKey: "cover_photo")
        dictionary.setValue(self.civil_id, forKey: "civil_id")
        dictionary.setValue(self.chalet_ownership, forKey: "chalet_ownership")
        dictionary.setValue(self.bank_holder_name, forKey: "bank_holder_name")
        dictionary.setValue(self.bank_name, forKey: "bank_name")
        dictionary.setValue(self.iban_num, forKey: "iban_num")
        dictionary.setValue(self.availablility_status, forKey: "availablility_status")
        dictionary.setValue(self.created_at, forKey: "created_at")
        dictionary.setValue(self.updated_at, forKey: "updated_at")
        dictionary.setValue(self.remaining_amt_pay, forKey: "remaining_amt_pay")
        dictionary.setValue(self.available_deposit, forKey: "available_deposit")

        return dictionary
    }

}

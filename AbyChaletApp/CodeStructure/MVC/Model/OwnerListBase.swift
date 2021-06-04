

import Foundation
 

public class OwnerListBase {
	public var status : Bool?
	public var message : String?
	public var owner : Owner?
	public var reservation_list : [Reservation_list]?

    public class func modelsFromDictionaryArray(array:NSArray) -> [OwnerListBase]
    {
        var models:[OwnerListBase] = []
        for item in array
        {
            models.append(OwnerListBase(dictionary: item as! NSDictionary)!)
        }
        return models
    }

	required public init?(dictionary: NSDictionary) {

		status = dictionary["status"] as? Bool
		message = dictionary["message"] as? String
		if (dictionary["owner"] != nil) { owner = Owner(dictionary: dictionary["owner"] as! NSDictionary) }
        if (dictionary["reservation_list"] != nil) { reservation_list = Reservation_list.modelsFromDictionaryArray(array: dictionary["reservation_list"] as! NSArray) }
	}

	public func dictionaryRepresentation() -> NSDictionary {

		let dictionary = NSMutableDictionary()

		dictionary.setValue(self.status, forKey: "status")
		dictionary.setValue(self.message, forKey: "message")
		dictionary.setValue(self.owner?.dictionaryRepresentation(), forKey: "owner")

		return dictionary
	}

}
public class Reservation_list {
    public var id : Int?
    public var userid : Int?
    public var chaletid : Int?
    public var ownerid : Int?
    public var selected_package : String?
    public var check_in : String?
    public var check_out : String?
    public var checkin_time : String?
    public var checkout_time : String?
    public var reservation_id : String?
    public var booking_status : String?
    public var total_paid : String?
    public var reward_discount : String?
    public var deposit : String?
    public var status : String?
    public var offer_discount : String?
    public var payment_gateway : String?
    public var payment_id : String?
    public var authorization_id : String?
    public var track_id : String?
    public var transaction_id : String?
    public var invoice_reference : String?
    public var reference_id : String?
    public var ownerChalet_details : [OwnerChalet_details]?

    public class func modelsFromDictionaryArray(array:NSArray) -> [Reservation_list]
    {
        var models:[Reservation_list] = []
        for item in array
        {
            models.append(Reservation_list(dictionary: item as! NSDictionary)!)
        }
        return models
    }

    required public init?(dictionary: NSDictionary) {

        id = dictionary["id"] as? Int
        userid = dictionary["userid"] as? Int
        chaletid = dictionary["chaletid"] as? Int
        ownerid = dictionary["ownerid"] as? Int
        selected_package = dictionary["selected_package"] as? String
        check_in = dictionary["check_in"] as? String
        check_out = dictionary["check_out"] as? String
        checkin_time = dictionary["checkin_time"] as? String
        checkout_time = dictionary["checkout_time"] as? String
        reservation_id = dictionary["reservation_id"] as? String
        booking_status = dictionary["booking_status"] as? String
        total_paid = dictionary["total_paid"] as? String
        reward_discount = dictionary["reward_discount"] as? String
        deposit = dictionary["deposit"] as? String
        status = dictionary["status"] as? String
        offer_discount = dictionary["offer_discount"] as? String
        payment_gateway = dictionary["payment_gateway"] as? String
        payment_id = dictionary["payment_id"] as? String
        authorization_id = dictionary["authorization_id"] as? String
        track_id = dictionary["track_id"] as? String
        transaction_id = dictionary["transaction_id"] as? String
        invoice_reference = dictionary["invoice_reference"] as? String
        reference_id = dictionary["reference_id"] as? String
        if (dictionary["chalet_details"] != nil) { ownerChalet_details = OwnerChalet_details.modelsFromDictionaryArray(array: dictionary["chalet_details"] as! NSArray) }
    }

    public func dictionaryRepresentation() -> NSDictionary {

        let dictionary = NSMutableDictionary()

        dictionary.setValue(self.id, forKey: "id")
        dictionary.setValue(self.userid, forKey: "userid")
        dictionary.setValue(self.chaletid, forKey: "chaletid")
        dictionary.setValue(self.ownerid, forKey: "ownerid")
        dictionary.setValue(self.selected_package, forKey: "selected_package")
        dictionary.setValue(self.check_in, forKey: "check_in")
        dictionary.setValue(self.check_out, forKey: "check_out")
        dictionary.setValue(self.checkin_time, forKey: "checkin_time")
        dictionary.setValue(self.checkout_time, forKey: "checkout_time")
        dictionary.setValue(self.reservation_id, forKey: "reservation_id")
        dictionary.setValue(self.booking_status, forKey: "booking_status")
        dictionary.setValue(self.total_paid, forKey: "total_paid")
        dictionary.setValue(self.reward_discount, forKey: "reward_discount")
        dictionary.setValue(self.deposit, forKey: "deposit")
        dictionary.setValue(self.status, forKey: "status")
        dictionary.setValue(self.offer_discount, forKey: "offer_discount")
        dictionary.setValue(self.payment_gateway, forKey: "payment_gateway")
        dictionary.setValue(self.payment_id, forKey: "payment_id")
        dictionary.setValue(self.authorization_id, forKey: "authorization_id")
        dictionary.setValue(self.track_id, forKey: "track_id")
        dictionary.setValue(self.transaction_id, forKey: "transaction_id")
        dictionary.setValue(self.invoice_reference, forKey: "invoice_reference")
        dictionary.setValue(self.reference_id, forKey: "reference_id")

        return dictionary
    }

}
public class Owner {
    public var owner_id : Int?
    public var firstname : String?
    public var lastname : String?
    public var email : String?
    public var password : String?
    public var country : String?
    public var phone : String?
    public var gender : String?
    public var profile_pic : String?
    public var civil_id : String?
    public var chalet_ownership : String?
    public var bank_holder_name : String?
    public var bank_name : String?
    public var iban_num : String?


    public class func modelsFromDictionaryArray(array:NSArray) -> [Owner]
    {
        var models:[Owner] = []
        for item in array
        {
            models.append(Owner(dictionary: item as! NSDictionary)!)
        }
        return models
    }

    required public init?(dictionary: NSDictionary) {

        owner_id = dictionary["owner_id"] as? Int
        firstname = dictionary["firstname"] as? String
        lastname = dictionary["lastname"] as? String
        email = dictionary["email"] as? String
        password = dictionary["password"] as? String
        country = dictionary["country"] as? String
        phone = dictionary["phone"] as? String
        gender = dictionary["gender"] as? String
        profile_pic = dictionary["profile_pic"] as? String
        civil_id = dictionary["civil_id"] as? String
        chalet_ownership = dictionary["chalet_ownership"] as? String
        bank_holder_name = dictionary["bank_holder_name"] as? String
        bank_name = dictionary["bank_name"] as? String
        iban_num = dictionary["iban_num"] as? String
    }

    public func dictionaryRepresentation() -> NSDictionary {

        let dictionary = NSMutableDictionary()

        dictionary.setValue(self.owner_id, forKey: "owner_id")
        dictionary.setValue(self.firstname, forKey: "firstname")
        dictionary.setValue(self.lastname, forKey: "lastname")
        dictionary.setValue(self.email, forKey: "email")
        dictionary.setValue(self.password, forKey: "password")
        dictionary.setValue(self.country, forKey: "country")
        dictionary.setValue(self.phone, forKey: "phone")
        dictionary.setValue(self.gender, forKey: "gender")
        dictionary.setValue(self.profile_pic, forKey: "profile_pic")
        dictionary.setValue(self.civil_id, forKey: "civil_id")
        dictionary.setValue(self.chalet_ownership, forKey: "chalet_ownership")
        dictionary.setValue(self.bank_holder_name, forKey: "bank_holder_name")
        dictionary.setValue(self.bank_name, forKey: "bank_name")
        dictionary.setValue(self.iban_num, forKey: "iban_num")

        return dictionary
    }

}
public class OwnerChalet_details {
    public var chalet_id : Int?
    public var chalet_name : String?
    public var location : String?
    public var latitude : Double?
    public var longitude : Double?
    public var cover_photo : String?
    public var weekday_rent : String?
    public var weekend_rent : String?
    public var week_rent : String?
    public var chalet_details : [Chalet_details]?
    public var chalet_upload : [Chalet_upload]?
    public var created_at : String?
    public var updated_at : String?


    public class func modelsFromDictionaryArray(array:NSArray) -> [OwnerChalet_details]
    {
        var models:[OwnerChalet_details] = []
        for item in array
        {
            models.append(OwnerChalet_details(dictionary: item as! NSDictionary)!)
        }
        return models
    }

    required public init?(dictionary: NSDictionary) {

        chalet_id = dictionary["chalet_id"] as? Int
        chalet_name = dictionary["chalet_name"] as? String
        location = dictionary["location"] as? String
        latitude = dictionary["latitude"] as? Double
        longitude = dictionary["longitude"] as? Double
        cover_photo = dictionary["cover_photo"] as? String
        weekday_rent = dictionary["weekday_rent"] as? String
        weekend_rent = dictionary["weekend_rent"] as? String
        week_rent = dictionary["week_rent"] as? String
        if (dictionary["chalet_details"] != nil) { chalet_details = Chalet_details.modelsFromDictionaryArray(array: dictionary["chalet_details"] as! NSArray) }
        if (dictionary["chalet_upload"] != nil) { chalet_upload = Chalet_upload.modelsFromDictionaryArray(array: dictionary["chalet_upload"] as! NSArray) }
        created_at = dictionary["created_at"] as? String
        updated_at = dictionary["updated_at"] as? String
    }

    public func dictionaryRepresentation() -> NSDictionary {

        let dictionary = NSMutableDictionary()

        dictionary.setValue(self.chalet_id, forKey: "chalet_id")
        dictionary.setValue(self.chalet_name, forKey: "chalet_name")
        dictionary.setValue(self.location, forKey: "location")
        dictionary.setValue(self.latitude, forKey: "latitude")
        dictionary.setValue(self.longitude, forKey: "longitude")
        dictionary.setValue(self.cover_photo, forKey: "cover_photo")
        dictionary.setValue(self.weekday_rent, forKey: "weekday_rent")
        dictionary.setValue(self.weekend_rent, forKey: "weekend_rent")
        dictionary.setValue(self.week_rent, forKey: "week_rent")
        dictionary.setValue(self.created_at, forKey: "created_at")
        dictionary.setValue(self.updated_at, forKey: "updated_at")

        return dictionary
    }

}

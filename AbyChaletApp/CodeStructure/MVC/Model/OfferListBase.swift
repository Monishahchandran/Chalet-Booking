

import Foundation
 
public class OfferListBase {
	public var status : Bool?
	public var message : String?
	public var admin : Admin?
	public var offerChalet_list : [OfferChalet_list]?


    public class func modelsFromDictionaryArray(array:NSArray) -> [OfferListBase]
    {
        var models:[OfferListBase] = []
        for item in array
        {
            models.append(OfferListBase(dictionary: item as! NSDictionary)!)
        }
        return models
    }


	required public init?(dictionary: NSDictionary) {

		status = dictionary["status"] as? Bool
		message = dictionary["message"] as? String
		if (dictionary["admin"] != nil) { admin = Admin(dictionary: dictionary["admin"] as! NSDictionary) }
        if (dictionary["chalet_list"] != nil) { offerChalet_list = OfferChalet_list.modelsFromDictionaryArray(array: dictionary["chalet_list"] as! NSArray) }
	}


	public func dictionaryRepresentation() -> NSDictionary {

		let dictionary = NSMutableDictionary()

		dictionary.setValue(self.status, forKey: "status")
		dictionary.setValue(self.message, forKey: "message")
		dictionary.setValue(self.admin?.dictionaryRepresentation(), forKey: "admin")

		return dictionary
	}

}
public class OfferChalet_list {
    public var offer_id : Int?
    public var offer_checkin : String?
    public var offer_checkout : String?
    public var offer_created_at : String?
    
    public var offerUser_details : [OfferUser_details]?


    public class func modelsFromDictionaryArray(array:NSArray) -> [OfferChalet_list]
    {
        var models:[OfferChalet_list] = []
        for item in array
        {
            models.append(OfferChalet_list(dictionary: item as! NSDictionary)!)
        }
        return models
    }

    required public init?(dictionary: NSDictionary) {

        offer_id = dictionary["offer_id"] as? Int
        offer_checkin = dictionary["offer_checkin"] as? String
        offer_checkout = dictionary["offer_checkout"] as? String
        offer_created_at = dictionary["created_at"] as? String
        if (dictionary["user_details"] != nil) { offerUser_details = OfferUser_details.modelsFromDictionaryArray(array: dictionary["user_details"] as! NSArray) }
    }

    public func dictionaryRepresentation() -> NSDictionary {

        let dictionary = NSMutableDictionary()

        dictionary.setValue(self.offer_id, forKey: "offer_id")
        dictionary.setValue(self.offer_checkin, forKey: "offer_checkin")
        dictionary.setValue(self.offer_checkout, forKey: "offer_checkout")
        dictionary.setValue(self.offer_created_at, forKey: "created_at")

        return dictionary
    }

}
public class OfferUser_details {
    public var chalet_id : Int?
    public var chalet_name : String?
    public var admincheck_in : String?
    public var admincheck_out : String?
    public var check_in : String?
    public var check_out : String?
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
    public var min_deposit : String?
    public var original_price : Int?
    public var rent : Int?
    public var discount_amt : Int?
    public var chalet_details : [Chalet_details]?
    public var chalet_upload : [Chalet_upload]?
    public var created_at : String?
    public var updated_at : String?
    public var package : String?

    public class func modelsFromDictionaryArray(array:NSArray) -> [OfferUser_details]
    {
        var models:[OfferUser_details] = []
        for item in array
        {
            models.append(OfferUser_details(dictionary: item as! NSDictionary)!)
        }
        return models
    }

    required public init?(dictionary: NSDictionary) {

        chalet_id = dictionary["chalet_id"] as? Int
        chalet_name = dictionary["chalet_name"] as? String
        admincheck_in = dictionary["admincheck_in"] as? String
        admincheck_out = dictionary["admincheck_out"] as? String
        check_in = dictionary["check_in"] as? String
        check_out = dictionary["check_out"] as? String
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
        min_deposit = dictionary["min_deposit"] as? String
        original_price = dictionary["original_price"] as? Int
        rent = dictionary["rent"] as? Int
        discount_amt = dictionary["discount_amt"] as? Int
        if (dictionary["chalet_details"] != nil) { chalet_details = Chalet_details.modelsFromDictionaryArray(array: dictionary["chalet_details"] as! NSArray) }
        if (dictionary["chalet_upload"] != nil) { chalet_upload = Chalet_upload.modelsFromDictionaryArray(array: dictionary["chalet_upload"] as! NSArray) }
        created_at = dictionary["created_at"] as? String
        updated_at = dictionary["updated_at"] as? String
        package = dictionary["package"] as? String
    }

    public func dictionaryRepresentation() -> NSDictionary {

        let dictionary = NSMutableDictionary()

        dictionary.setValue(self.chalet_id, forKey: "chalet_id")
        dictionary.setValue(self.chalet_name, forKey: "chalet_name")
        dictionary.setValue(self.admincheck_in, forKey: "admincheck_in")
        dictionary.setValue(self.admincheck_out, forKey: "admincheck_out")
        dictionary.setValue(self.check_in, forKey: "check_in")
        dictionary.setValue(self.check_out, forKey: "check_out")
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
        dictionary.setValue(self.original_price, forKey: "original_price")
        dictionary.setValue(self.rent, forKey: "rent")
        dictionary.setValue(self.discount_amt, forKey: "discount_amt")
        dictionary.setValue(self.created_at, forKey: "created_at")
        dictionary.setValue(self.updated_at, forKey: "updated_at")
        dictionary.setValue(self.min_deposit, forKey: "min_deposit")
        return dictionary
    }

}
public class Admin {
    public var remaining_amt : String?
    public var offer_expiry : String?
    
    public class func modelsFromDictionaryArray(array:NSArray) -> [Admin]
    {
        var models:[Admin] = []
        for item in array
        {
            models.append(Admin(dictionary: item as! NSDictionary)!)
        }
        return models
    }

    required public init?(dictionary: NSDictionary) {

        remaining_amt = dictionary["remaining_amt"] as? String
        offer_expiry = dictionary["offer_expiry"] as? String
    }

    public func dictionaryRepresentation() -> NSDictionary {

        let dictionary = NSMutableDictionary()

        dictionary.setValue(self.remaining_amt, forKey: "remaining_amt")
        dictionary.setValue(self.offer_expiry, forKey: "offer_expiry")

        return dictionary
    }

}

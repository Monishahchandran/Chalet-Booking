

import Foundation
 

public class ChaletSearchBase {
	public var status : Bool?
	public var message : String?
	public var user_details : [User_details]?


    public class func modelsFromDictionaryArray(array:NSArray) -> [ChaletSearchBase]
    {
        var models:[ChaletSearchBase] = []
        for item in array
        {
            models.append(ChaletSearchBase(dictionary: item as! NSDictionary)!)
        }
        return models
    }


	required public init?(dictionary: NSDictionary) {

		status = dictionary["status"] as? Bool
		message = dictionary["message"] as? String
        if (dictionary["user_details"] != nil) { user_details = User_details.modelsFromDictionaryArray(array: dictionary["user_details"] as! NSArray) }
	}

	public func dictionaryRepresentation() -> NSDictionary {

		let dictionary = NSMutableDictionary()

		dictionary.setValue(self.status, forKey: "status")
		dictionary.setValue(self.message, forKey: "message")

		return dictionary
	}

}
public class User_details {
    public var slno : Int?
    public var chalet_id : Int?
    public var chalet_name : String?
    public var cover_photo : String?
    public var check_in : String?
    public var check_out : String?
    public var rent : String?
    public var admincheck_in : String?
    public var admincheck_out : String?
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
    public var min_deposit : String?
    public var available_deposit : String?
    public var remaining_amt_pay : String?
    public var offer_expiry : String?
    public var chalet_details : [Chalet_details]?
    public var chalet_upload : [Chalet_upload]?
    public var created_at : String?
    public var updated_at : String?


    public class func modelsFromDictionaryArray(array:NSArray) -> [User_details]
    {
        var models:[User_details] = []
        for item in array
        {
            models.append(User_details(dictionary: item as! NSDictionary)!)
        }
        return models
    }

    required public init?(dictionary: NSDictionary) {

        slno = dictionary["slno"] as? Int
        chalet_id = dictionary["chalet_id"] as? Int
        chalet_name = dictionary["chalet_name"] as? String
        cover_photo = dictionary["cover_photo"] as? String
        check_in = dictionary["check_in"] as? String
        check_out = dictionary["check_out"] as? String
        rent = dictionary["rent"] as? String
        admincheck_in = dictionary["admincheck_in"] as? String
        admincheck_out = dictionary["admincheck_out"] as? String
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
        min_deposit = dictionary["min_deposit"] as? String
        available_deposit = dictionary["available_deposit"] as? String
        remaining_amt_pay = dictionary["remaining_amt_pay"] as? String
        offer_expiry = dictionary["offer_expiry"] as? String
        if (dictionary["chalet_details"] != nil) { chalet_details = Chalet_details.modelsFromDictionaryArray(array: dictionary["chalet_details"] as! NSArray) }
        if (dictionary["chalet_upload"] != nil) { chalet_upload = Chalet_upload.modelsFromDictionaryArray(array: dictionary["chalet_upload"] as! NSArray) }
        created_at = dictionary["created_at"] as? String
        updated_at = dictionary["updated_at"] as? String
    }

    public func dictionaryRepresentation() -> NSDictionary {

        let dictionary = NSMutableDictionary()

        dictionary.setValue(self.slno, forKey: "slno")
        dictionary.setValue(self.chalet_id, forKey: "chalet_id")
        dictionary.setValue(self.chalet_name, forKey: "chalet_name")
        dictionary.setValue(self.cover_photo, forKey: "cover_photo")
        dictionary.setValue(self.check_in, forKey: "check_in")
        dictionary.setValue(self.check_out, forKey: "check_out")
        dictionary.setValue(self.rent, forKey: "rent")
        dictionary.setValue(self.admincheck_in, forKey: "admincheck_in")
        dictionary.setValue(self.admincheck_out, forKey: "admincheck_out")
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
        dictionary.setValue(self.min_deposit, forKey: "min_deposit")
        dictionary.setValue(self.available_deposit, forKey: "available_deposit")
        dictionary.setValue(self.remaining_amt_pay, forKey: "remaining_amt_pay")
        dictionary.setValue(self.offer_expiry, forKey: "offer_expiry")
        dictionary.setValue(self.created_at, forKey: "created_at")
        dictionary.setValue(self.updated_at, forKey: "updated_at")

        return dictionary
    }

}
public class Chalet_details {
    public var id : Int?
    public var chalet_details : String?

    public class func modelsFromDictionaryArray(array:NSArray) -> [Chalet_details]
    {
        var models:[Chalet_details] = []
        for item in array
        {
            models.append(Chalet_details(dictionary: item as! NSDictionary)!)
        }
        return models
    }

    required public init?(dictionary: NSDictionary) {

        id = dictionary["id"] as? Int
        chalet_details = dictionary["chalet_details"] as? String
    }

    public func dictionaryRepresentation() -> NSDictionary {

        let dictionary = NSMutableDictionary()

        dictionary.setValue(self.id, forKey: "id")
        dictionary.setValue(self.chalet_details, forKey: "chalet_details")

        return dictionary
    }

}
public class Chalet_upload {
    public var id : Int?
    public var chalet_id : Int?
    public var file_name : String?

    public class func modelsFromDictionaryArray(array:NSArray) -> [Chalet_upload]
    {
        var models:[Chalet_upload] = []
        for item in array
        {
            models.append(Chalet_upload(dictionary: item as! NSDictionary)!)
        }
        return models
    }

    required public init?(dictionary: NSDictionary) {

        id = dictionary["id"] as? Int
        chalet_id = dictionary["chalet_id"] as? Int
        file_name = dictionary["file_name"] as? String
    }


    public func dictionaryRepresentation() -> NSDictionary {

        let dictionary = NSMutableDictionary()

        dictionary.setValue(self.id, forKey: "id")
        dictionary.setValue(self.chalet_id, forKey: "chalet_id")
        dictionary.setValue(self.file_name, forKey: "file_name")

        return dictionary
    }

}



import Foundation
 

public class ContactUsBase {
	public var status : Bool?
	public var message : String?
	public var contact_list : [Contact_list]?


    public class func modelsFromDictionaryArray(array:NSArray) -> [ContactUsBase]
    {
        var models:[ContactUsBase] = []
        for item in array
        {
            models.append(ContactUsBase(dictionary: item as! NSDictionary)!)
        }
        return models
    }

	required public init?(dictionary: NSDictionary) {

		status = dictionary["status"] as? Bool
		message = dictionary["message"] as? String
        if (dictionary["contact_list"] != nil) { contact_list = Contact_list.modelsFromDictionaryArray(array: dictionary["contact_list"] as! NSArray) }
	}

	public func dictionaryRepresentation() -> NSDictionary {

		let dictionary = NSMutableDictionary()

		dictionary.setValue(self.status, forKey: "status")
		dictionary.setValue(self.message, forKey: "message")

		return dictionary
	}

}
public class Contact_list {
    public var id : Int?
    public var name : String?
    public var phone : String?
    public var profile_pic : String?
    public var created_at : String?
    public var updated_at : String?


    public class func modelsFromDictionaryArray(array:NSArray) -> [Contact_list]
    {
        var models:[Contact_list] = []
        for item in array
        {
            models.append(Contact_list(dictionary: item as! NSDictionary)!)
        }
        return models
    }


    required public init?(dictionary: NSDictionary) {

        id = dictionary["id"] as? Int
        name = dictionary["name"] as? String
        phone = dictionary["phone"] as? String
        profile_pic = dictionary["profile_pic"] as? String
        created_at = dictionary["created_at"] as? String
        updated_at = dictionary["updated_at"] as? String
    }


    public func dictionaryRepresentation() -> NSDictionary {

        let dictionary = NSMutableDictionary()

        dictionary.setValue(self.id, forKey: "id")
        dictionary.setValue(self.name, forKey: "name")
        dictionary.setValue(self.phone, forKey: "phone")
        dictionary.setValue(self.profile_pic, forKey: "profile_pic")
        dictionary.setValue(self.created_at, forKey: "created_at")
        dictionary.setValue(self.updated_at, forKey: "updated_at")

        return dictionary
    }

}

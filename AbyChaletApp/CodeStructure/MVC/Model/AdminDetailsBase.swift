

import Foundation
 

public class AdminDetailsBase {
	public var status : Bool?
	public var message : String?
	public var admin_details : [Admin_details]?


    public class func modelsFromDictionaryArray(array:NSArray) -> [AdminDetailsBase]
    {
        var models:[AdminDetailsBase] = []
        for item in array
        {
            models.append(AdminDetailsBase(dictionary: item as! NSDictionary)!)
        }
        return models
    }


	required public init?(dictionary: NSDictionary) {

		status = dictionary["status"] as? Bool
		message = dictionary["message"] as? String
        if (dictionary["admin_details"] != nil) { admin_details = Admin_details.modelsFromDictionaryArray(array: dictionary["admin_details"] as! NSArray) }
	}

	public func dictionaryRepresentation() -> NSDictionary {

		let dictionary = NSMutableDictionary()

		dictionary.setValue(self.status, forKey: "status")
		dictionary.setValue(self.message, forKey: "message")

		return dictionary
	}

}
public class Admin_details {
    public var id : Int?
    public var insta_url : String?
    public var terms_url : String?
    public var legal_privacy : String?
    public var shareapp_url : String?
    public var invite_friend : String?
    public var timezone : String?


    public class func modelsFromDictionaryArray(array:NSArray) -> [Admin_details]
    {
        var models:[Admin_details] = []
        for item in array
        {
            models.append(Admin_details(dictionary: item as! NSDictionary)!)
        }
        return models
    }

    required public init?(dictionary: NSDictionary) {

        id = dictionary["id"] as? Int
        insta_url = dictionary["insta_url"] as? String
        terms_url = dictionary["terms_url"] as? String
        legal_privacy = dictionary["legal_privacy"] as? String
        shareapp_url = dictionary["shareapp_url"] as? String
        invite_friend = dictionary["invite_friend"] as? String
        timezone = dictionary["timezone"] as? String
    }

    public func dictionaryRepresentation() -> NSDictionary {

        let dictionary = NSMutableDictionary()

        dictionary.setValue(self.id, forKey: "id")
        dictionary.setValue(self.insta_url, forKey: "insta_url")
        dictionary.setValue(self.terms_url, forKey: "terms_url")
        dictionary.setValue(self.legal_privacy, forKey: "legal_privacy")
        dictionary.setValue(self.shareapp_url, forKey: "shareapp_url")
        dictionary.setValue(self.invite_friend, forKey: "invite_friend")
        dictionary.setValue(self.timezone, forKey: "timezone")

        return dictionary
    }

}

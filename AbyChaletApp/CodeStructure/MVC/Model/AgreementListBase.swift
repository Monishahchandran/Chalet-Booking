

import Foundation
 

public class AgreementListBase {
	public var status : Bool?
	public var message : String?
	public var agreement : Array<Agreement>?


    public class func modelsFromDictionaryArray(array:NSArray) -> [AgreementListBase]
    {
        var models:[AgreementListBase] = []
        for item in array
        {
            models.append(AgreementListBase(dictionary: item as! NSDictionary)!)
        }
        return models
    }

	required public init?(dictionary: NSDictionary) {

		status = dictionary["status"] as? Bool
		message = dictionary["message"] as? String
        if (dictionary["agreement"] != nil) { agreement = Agreement.modelsFromDictionaryArray(array: dictionary["agreement"] as! NSArray) }
	}

	public func dictionaryRepresentation() -> NSDictionary {

		let dictionary = NSMutableDictionary()

		dictionary.setValue(self.status, forKey: "status")
		dictionary.setValue(self.message, forKey: "message")

		return dictionary
	}

}
public class Agreement {
    public var id : Int?
    public var agreement_content : String?
    public var created_at : String?
    public var updated_at : String?


    public class func modelsFromDictionaryArray(array:NSArray) -> [Agreement]
    {
        var models:[Agreement] = []
        for item in array
        {
            models.append(Agreement(dictionary: item as! NSDictionary)!)
        }
        return models
    }

    required public init?(dictionary: NSDictionary) {

        id = dictionary["id"] as? Int
        agreement_content = dictionary["agreement_content"] as? String
        created_at = dictionary["created_at"] as? String
        updated_at = dictionary["updated_at"] as? String
    }

    public func dictionaryRepresentation() -> NSDictionary {

        let dictionary = NSMutableDictionary()

        dictionary.setValue(self.id, forKey: "id")
        dictionary.setValue(self.agreement_content, forKey: "agreement_content")
        dictionary.setValue(self.created_at, forKey: "created_at")
        dictionary.setValue(self.updated_at, forKey: "updated_at")

        return dictionary
    }

}

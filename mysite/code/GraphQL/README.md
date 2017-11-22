
**The Hub Graph QL example queries**



models query


    {
        models (slug: "asx-20-xls-petrol-2wd") {
            id
            name
            swatches {
                id
                name
                slug
                clearcut360s {
                    id
                    order
                    path
                    start
                }
            }
        }
    }


vehicles query. See the Vehicle Page Controlelr class for the full vehicle query.

     {   
          vehicles (name: "ASX") {
               models {
                   name
                   slug
                   defaultAngleImage
                   uniqueSpecs {
                       id
                       name
                       icon
                   }
                   rrp
                   onPromotion
                }
            }
     }    









**SilverStripe GraphQL examples**

visit https://mmnz-2.dev/dev/graphiql/ to see the responses



A query from just adding yaml configs for a DataObject (MenuSets)
returns a paginated list

        
        query {
            readMenuSets {
                pageInfo 	{
                    totalCount
                    hasNextPage
                    hasPreviousPage
                }
                edges {
                    node {
                        ID,
                        Name
                    }
                }
            }
        }



getting the list of MenusSets from Query & Type  - note $Name not doing anything in this query

        
        query ($Name: String) {
            getMenus(Name: $Name) {
                ID
                Name
            }
        }
        

to retrieve MenuSet by Name
        
        
        query {
            getMenus(Name: "Buyers") {
                ID
                Name
            }
        }
        


get MenuSet with MenuItems

        
        query {
            readMenuSets {
                pageInfo {
                    totalCount
                    hasNextPage
                    hasPreviousPage
                }
                edges {
                    node {
                        ID,
                        Name
                      	MenuItems {
                          edges {
                            node {
                              ID
                              MenuTitle
                              Link
                              IsNewWindow
                            }
                          }
                        }
                    }
                }
            }
        }
        
        
        
get MenuSet with MenuItems by Name !! WhopWhoop!

        query {
            readMenuSets (Name: "Buyers") {
                pageInfo {
                    totalCount
                    hasNextPage
                    hasPreviousPage
                }
                edges {
                    node {
                        ID,
                        Name
                        MenuItems {
                          edges {
                            node {
                              ID
                              MenuTitle
                              Link
                              IsNewWindow
                            }
                          }
                        }
                    }
                }
            }
        }




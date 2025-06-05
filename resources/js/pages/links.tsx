import AppLayout from "@/layouts/app-layout";
import { type BreadcrumbItem } from "@/types";
import { Head, useForm } from "@inertiajs/react";
import { Button } from "@/components/ui/button";
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "@/components/ui/dialog";
import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
} from "@/components/ui/alert-dialog";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table";
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import { Badge } from "@/components/ui/badge";
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
import {
  Copy,
  ExternalLink,
  MoreVertical,
  Plus,
  Trash2,
  Edit,
} from "lucide-react";
import { useState } from "react";
import { toast } from "sonner";

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: "Links",
    href: "/my/links",
  },
];

interface Link {
  id: number;
  url: string;
  short_url: string;
  user_id: number;
  clicks_count: number;
  created_at: string;
  updated_at: string;
}

interface LinksProps {
  links: Link[];
}

export default function Links({ links = [] }: LinksProps) {
  const [isCreateDialogOpen, setIsCreateDialogOpen] = useState(false);
  const [isEditDialogOpen, setIsEditDialogOpen] = useState(false);
  const [isDeleteDialogOpen, setIsDeleteDialogOpen] = useState(false);
  const [editingLink, setEditingLink] = useState<Link | null>(null);
  const [deletingLink, setDeletingLink] = useState<Link | null>(null);

  const {
    data,
    setData,
    post,
    patch,
    delete: destroy,
    processing,
    errors,
    reset,
  } = useForm({
    url: "",
    short_url: "",
  });

  const handleCreateLink = (e: React.FormEvent) => {
    e.preventDefault();
    post("/my/links", {
      onSuccess: () => {
        setIsCreateDialogOpen(false);
        reset();
        toast.success("Link created successfully!");
      },
    });
  };

  const openEditDialog = (link: Link) => {
    setEditingLink(link);
    setData({
      url: link.url,
      short_url: link.short_url,
    });
    setIsEditDialogOpen(true);
  };

  const handleEditLink = (e: React.FormEvent) => {
    e.preventDefault();
    if (!editingLink) return;
    patch(`/my/links/${editingLink.id}`, {
      onSuccess: () => {
        setIsEditDialogOpen(false);
        setEditingLink(null);
        reset();
        toast.success("Link updated successfully!");
      },
    });
  };

  const openDeleteDialog = (link: Link) => {
    setDeletingLink(link);
    setIsDeleteDialogOpen(true);
  };

  const handleDeleteLink = () => {
    if (!deletingLink) return;
    destroy(`/my/links/${deletingLink.id}`, {
      onSuccess: () => {
        toast.success("Link deleted successfully!");
        setIsDeleteDialogOpen(false);
        setDeletingLink(null);
      },
    });
  };

  const copyToClipboard = (shortUrl: string) => {
    const fullUrl = `${window.location.origin}/${shortUrl}`;
    navigator.clipboard.writeText(fullUrl);
    toast.success("Full link copied to clipboard!");
  };

  const formatDate = (dateString: string) => {
    return new Date(dateString).toLocaleDateString("en-GB");
  };

  return (
    <AppLayout breadcrumbs={breadcrumbs}>
      <Head title="Links" />
      <div className="flex flex-1 flex-col">
        <div className="@container/main flex flex-1 flex-col gap-2">
          <div className="flex flex-col gap-4 py-4 md:gap-6 md:py-6">
            <div className="px-4 lg:px-6">
              <Card>
                <CardHeader>
                  <div className="flex items-center justify-between">
                    <div>
                      <CardTitle>Your Links</CardTitle>
                      <CardDescription>
                        Manage and track your shortened links
                      </CardDescription>
                    </div>
                    <Dialog
                      open={isCreateDialogOpen}
                      onOpenChange={setIsCreateDialogOpen}
                    >
                      <DialogTrigger asChild>
                        <Button>
                          <Plus className="h-4 w-4 mr-2" />
                          Create Link
                        </Button>
                      </DialogTrigger>
                      <DialogContent className="sm:max-w-[425px]">
                        <form onSubmit={handleCreateLink}>
                          <DialogHeader>
                            <DialogTitle>Create New Link</DialogTitle>
                            <DialogDescription>
                              Enter the URL you want to shorten and customize
                              it.
                            </DialogDescription>
                          </DialogHeader>
                          <div className="grid gap-4 py-4">
                            <div className="grid gap-2">
                              <Label htmlFor="url">Original URL</Label>
                              <Input
                                id="url"
                                type="url"
                                placeholder="https://example.com"
                                value={data.url}
                                onChange={(e) => setData("url", e.target.value)}
                                required
                              />
                              {errors.url && (
                                <p className="text-sm text-destructive">
                                  {errors.url}
                                </p>
                              )}
                            </div>
                            <div className="grid gap-2">
                              <Label htmlFor="short_url">
                                Custom Short URL (Optional)
                              </Label>
                              <div className="flex items-center space-x-2">
                                <span className="text-sm text-muted-foreground">
                                  {window.location.origin}/
                                </span>
                                <Input
                                  id="short_url"
                                  placeholder="my-custom-link"
                                  value={data.short_url}
                                  onChange={(e) =>
                                    setData("short_url", e.target.value)
                                  }
                                />
                              </div>
                              {errors.short_url && (
                                <p className="text-sm text-destructive">
                                  {errors.short_url}
                                </p>
                              )}
                              <p className="text-xs text-muted-foreground">
                                Leave empty to generate automatically
                              </p>
                            </div>
                          </div>
                          <DialogFooter>
                            <Button
                              type="button"
                              variant="outline"
                              onClick={() => setIsCreateDialogOpen(false)}
                            >
                              Cancel
                            </Button>
                            <Button type="submit" disabled={processing}>
                              {processing ? "Creating..." : "Create Link"}
                            </Button>
                          </DialogFooter>
                        </form>
                      </DialogContent>
                    </Dialog>
                  </div>
                </CardHeader>
                <CardContent>
                  {links.length === 0 ? (
                    <div className="text-center py-8">
                      <p className="text-muted-foreground mb-4">
                        No links found
                      </p>
                      <Button
                        variant="outline"
                        onClick={() => setIsCreateDialogOpen(true)}
                      >
                        <Plus className="h-4 w-4 mr-2" />
                        Create your first link
                      </Button>
                    </div>
                  ) : (
                    <div className="rounded-md border">
                      <Table>
                        <TableHeader>
                          <TableRow>
                            <TableHead>Link</TableHead>
                            <TableHead>Original URL</TableHead>
                            <TableHead>Clicks</TableHead>
                            <TableHead>Created</TableHead>
                            <TableHead className="text-right">
                              Actions
                            </TableHead>
                          </TableRow>
                        </TableHeader>
                        <TableBody>
                          {links.map((link) => (
                            <TableRow key={link.id}>
                              <TableCell>
                                <div className="space-y-1">
                                  <div className="flex items-center space-x-2">
                                    <code className="relative rounded bg-muted px-[0.3rem] py-[0.2rem] font-mono text-sm">
                                      {link.short_url}
                                    </code>
                                    <Button
                                      variant="ghost"
                                      size="sm"
                                      onClick={() =>
                                        copyToClipboard(link.short_url)
                                      }
                                    >
                                      <Copy className="h-3 w-3" />
                                    </Button>
                                  </div>
                                </div>
                              </TableCell>
                              <TableCell>
                                <div className="flex items-center space-x-2">
                                  <span className="max-w-[200px] truncate">
                                    {link.url}
                                  </span>
                                  <Button
                                    variant="ghost"
                                    size="sm"
                                    onClick={() =>
                                      window.open(link.url, "_blank")
                                    }
                                  >
                                    <ExternalLink className="h-3 w-3" />
                                  </Button>
                                </div>
                              </TableCell>
                              <TableCell>
                                <Badge variant="secondary">
                                  {link.clicks_count}
                                </Badge>
                              </TableCell>
                              <TableCell className="text-muted-foreground">
                                {formatDate(link.created_at)}
                              </TableCell>
                              <TableCell className="text-right">
                                <DropdownMenu>
                                  <DropdownMenuTrigger asChild>
                                    <Button variant="ghost" size="sm">
                                      <MoreVertical className="h-4 w-4" />
                                    </Button>
                                  </DropdownMenuTrigger>
                                  <DropdownMenuContent align="end">
                                    <DropdownMenuItem
                                      onClick={() =>
                                        copyToClipboard(link.short_url)
                                      }
                                    >
                                      <Copy className="h-4 w-4 mr-2" />
                                      Copy Link
                                    </DropdownMenuItem>
                                    <DropdownMenuItem
                                      onClick={() => openEditDialog(link)}
                                    >
                                      <Edit className="h-4 w-4 mr-2" />
                                      Edit
                                    </DropdownMenuItem>
                                    <DropdownMenuItem
                                      onClick={() => openDeleteDialog(link)}
                                    >
                                      <Trash2 className="h-4 w-4 mr-2" />
                                      Delete
                                    </DropdownMenuItem>
                                  </DropdownMenuContent>
                                </DropdownMenu>
                              </TableCell>
                            </TableRow>
                          ))}
                        </TableBody>
                      </Table>
                    </div>
                  )}
                </CardContent>
              </Card>
            </div>
          </div>
        </div>
      </div>

      {/* Edit Dialog */}
      <Dialog open={isEditDialogOpen} onOpenChange={setIsEditDialogOpen}>
        <DialogContent className="sm:max-w-[425px]">
          <form onSubmit={handleEditLink}>
            <DialogHeader>
              <DialogTitle>Edit Link</DialogTitle>
              <DialogDescription>Update your link details.</DialogDescription>
            </DialogHeader>
            <div className="grid gap-4 py-4">
              <div className="grid gap-2">
                <Label htmlFor="edit-url">Original URL</Label>
                <Input
                  id="edit-url"
                  type="url"
                  value={data.url}
                  onChange={(e) => setData("url", e.target.value)}
                  required
                />
                {errors.url && (
                  <p className="text-sm text-destructive">{errors.url}</p>
                )}
              </div>
              <div className="grid gap-2">
                <Label htmlFor="edit-short_url">Short URL</Label>
                <div className="flex items-center space-x-2">
                  <span className="text-sm text-muted-foreground">
                    {window.location.origin}/
                  </span>
                  <Input
                    id="edit-short_url"
                    value={data.short_url}
                    onChange={(e) => setData("short_url", e.target.value)}
                    required
                  />
                </div>
                {errors.short_url && (
                  <p className="text-sm text-destructive">{errors.short_url}</p>
                )}
              </div>
            </div>
            <DialogFooter>
              <Button
                type="button"
                variant="outline"
                onClick={() => {
                  setIsEditDialogOpen(false);
                  setEditingLink(null);
                  reset();
                }}
              >
                Cancel
              </Button>
              <Button type="submit" disabled={processing}>
                {processing ? "Updating..." : "Update Link"}
              </Button>
            </DialogFooter>
          </form>
        </DialogContent>
      </Dialog>

      {/* Delete Confirmation Dialog */}
      <AlertDialog
        open={isDeleteDialogOpen}
        onOpenChange={setIsDeleteDialogOpen}
      >
        <AlertDialogContent>
          <AlertDialogHeader>
            <AlertDialogTitle>Are you absolutely sure?</AlertDialogTitle>
            <AlertDialogDescription>
              This action cannot be undone. This will permanently delete the
              link and remove all associated click data.
            </AlertDialogDescription>
          </AlertDialogHeader>
          <AlertDialogFooter>
            <AlertDialogCancel
              onClick={() => {
                setIsDeleteDialogOpen(false);
                setDeletingLink(null);
              }}
            >
              Cancel
            </AlertDialogCancel>
            <AlertDialogAction onClick={handleDeleteLink} disabled={processing}>
              {processing ? "Deleting..." : "Delete"}
            </AlertDialogAction>
          </AlertDialogFooter>
        </AlertDialogContent>
      </AlertDialog>
    </AppLayout>
  );
}
